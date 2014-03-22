<!DOCTYPE html>
<html>
  <head>
    <title>Le monde vu par le PAP</title>
    <meta charset="utf-8">
    <meta property="og:image" content="placeholder.png">
    <script src="lib/d3.v3.js"></script>
    <script src="lib/colorbrewer.js"></script>
    <script src="lib/topojson.js"></script>
    <script src="cartogram.js"></script>
    <style type="text/css">

      body {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; 
        font-size: 14px;
        line-height: 1.4em;
        padding: 0;
        margin: 0;
      }

      #container {
        width: 800px;
        margin: 20px auto;
      }

      h1 {
        font-size: 200%;
        margin: 0 0 15px 0;
      }

      h2 {
        font-size: 160%;
        margin: 0 0 10px 0;
      }

      p {
        margin: 0 0 10px;
      }

      form, form > * {
        margin: 0;
      }

      #status {
        color: #999;
      }

      #map-container {
        height: 500px;
        text-align: center;
        position: relative;
        margin: 20px 0;
      }

      #map {
        display: block;
        position: absolute;
        background: #fff;
        width: 100%;
        height: 100%;
        margin: 0;
      }

      path.state {
        stroke: #666;
        stroke-width: .5;
      }

      path.state:hover {
        stroke: #000;
      }

      form {
        font-size: 120%;
      }

      select {
        font-size: inherit;
      }

      #placeholder {
        position: absolute;
        z-index: -1;
        display: block;
        left: 0;
        top: 0;
      }
      
      .nodisplay {
        display:none;
      }

    </style>
  </head>
  <body>
      <div id="map-container">
        <svg id="map"></svg>
      </div>
	 <p style="text-align: right;"><a href="#" onClick="return false;" id="map-replay">Rejouer l'animation</a></p>
    <div id="container">
      <form>
        <p>
          <span style="display: none" id="status"></span><br>
        </p>
      </form>
      </div>
    <script>
      if (!document.createElementNS) {
        document.getElementsByTagName("form")[0].style.display = "none";
      }

      var percent = (function() {
            var fmt = d3.format('{: }');
            return function(n) { return fmt(n) + "%"; };
          })(),
          fields = [
            {name: "Aucune", id: "none"},
            {name: "Nombre d'aides accordées", id: "aide", key: "AIDESACCORDEES", unit: " <?php if (isset($_GET['by_editor']) && $_GET['by_editor']) { echo " éditeur(s)"; } else { echo " traduction(s)";} ?>"},
            ],
          fieldsById = d3.nest()
            .key(function(d) { return d.id; })
            .rollup(function(d) { return d[0]; })
            .map(fields),
          field = fields[0],
          colors = colorbrewer.BuPu[3]
            .map(function(rgb) { return d3.hsl(rgb); });

      var body = d3.select("body"),
          stat = d3.select("#status");

      var fieldSelect = d3.select("#field")
        .on("change", function(e) {
          field = fields[this.selectedIndex];
          location.hash = "#" + [field.id].join("/");
        });
        
      fieldSelect.selectAll("option")
        .data(fields)
        .enter()
        .append("option")
          .attr("value", function(d) { return d.id; })
          .text(function(d) { return d.name; });

      var map = d3.select("#map"),
          zoom = d3.behavior.zoom()
            .translate([-260,-25])
            .scale(1.29)
            //.scaleExtent([0.5, 10.0])
            .on("zoom", updateZoom),
          layer = map.append("g")
            .attr("id", "layer"),
          worldcountries = layer.append("g")
            .attr("id", "worldcountries")
            .selectAll("path");
          layer2 = map.append("g")
            .attr("id","layer2"),
          languages = layer.append("g")
            .attr("id","languages")
            .selectAll("circle");

      // map.call(zoom);
      updateZoom();

      function updateZoom() {
        var scale = zoom.scale();
        layer.attr("transform",
          "translate(" + zoom.translate() + ") " +
          "scale(" + [scale, scale] + ")");
      }

      var proj = d3.geo.mercator(),
          topology,
          geometries,
          rawData,
          dataById = {},
          carto = d3.cartogram()
            .projection(proj)
            .properties(function(d) {
              return dataById[d.id];
            })
            .value(function(d) {
              return +d.properties[field];
            });

      window.onhashchange = function() {
        parseHash();
      };

      var url = ["data",
            "worldcountries.topojson"
          ].join("/");
      d3.json(url, function(topo) {
        topology = topo;
        geometries = topology.objects.worldcountries.geometries;
        
        d3.csv("par_pays.php?<?php if (isset($_GET['q'])) { echo 'q='.urlencode($_GET['q']).'&';}if (isset($_GET['by_editor'])) { echo 'by_editor=1';} ?>", function(data) {
          rawData = data;
          dataById = d3.nest()
            .key(function(d) { try { return d.NAME; } catch(e) {return "UNKNOWN"; }})
            .rollup(function(d) {  return d[0]; })
            .map(data);
            init();
            cartographit();
        });
      });

      function init() {
        var features = carto.features(topology, geometries),
            path = d3.geo.path()
              .projection(proj);
        worldcountries = worldcountries.data(features)
          .enter()
          .append("path")
            .attr("class", "state")
            .attr("id", function(d) {
              try {
              	return d.properties.NAME;
              }catch(e) {return "UNKNOWN";}
            })
            .attr("fill", "#fafafa")
            .attr("d", path)
            .attr("cursor","pointer");
        worldcountries.append("title");
      }

      function reset() {
        stat.text("");
        body.classed("updating", false);
        
        var features = carto.features(topology, geometries),
            path = d3.geo.path()
              .projection(proj);

        worldcountries.data(features)
          .transition()
            .duration(750)
            .ease("linear")
            .attr("fill", "#fafafa")
            .attr("d", path);

        worldcountries.select("title")
          .text(function(d) {
            try{
                return d.properties['FULLNAME'];
	    }catch(e){
		return "rien pour ce pays";
	    }
          });
          
      }

      function update() {
        var start = Date.now();
        body.classed("updating", true);
        
        d3.select("#languages").classed("nodisplay",true)

        var key = field.key,
            fmt = (typeof field.format === "function")
              ? field.format
              : d3.format(field.format || ","),
            value = function(d) {
              try {
              return +d.properties[key];
	      }catch(e) {return 0;}
            },
            values = worldcountries.data()
              .map(value)
              .filter(function(n) {
                return !isNaN(n);
              })
              .sort(d3.ascending),
            lo = values[0],
            hi = values[values.length - 1];

        var color = d3.scale.linear()
          .range(colors)
          .domain(lo < 0
            ? [lo, 0, hi]
            : [lo, d3.mean(values), hi]);

        // normalize the scale to positive numbers
        var scale = d3.scale.linear()
          .domain([lo, hi])
          .range([10, 1000]);

        // tell the cartogram to use the scaled values
        carto.value(function(d) {
          return scale(value(d));
        });

        // generate the new features, pre-projected
        var features = carto(topology, geometries).features;

        // update the data
        worldcountries.data(features)
          .select("title")
            .text(function(d) {
              try{
              return [d.properties.FULLNAME, value(d)].join(" : ") + field.unit;
              }catch(e){return "Rien pour ce pays";}
            });

        worldcountries.transition()
          .duration(2750)
          .ease("linear")
          .attr("fill", function(d) {
            return color(value(d));
          })
          .attr("d", carto.path);

        var delta = (Date.now() - start) / 1000;
        stat.text(["calculé en", delta.toFixed(1), "secondes"].join(" "));
        body.classed("updating", false);
      }

      var deferredUpdate = (function() {
        var timeout;
        return function() {
          var args = arguments;
          clearTimeout(timeout);
          stat.text("Calcul en cours...");
          return timeout = setTimeout(function() {
            update.apply(null, arguments);
          }, 10);
        };
      })();

      var hashish = d3.selectAll("a.hashish")
        .datum(function() {
          return this.href;
        });
      d3.select("#map-replay").on("click", function(){
           reset();
           setTimeout(function() {cartographit()}, 1000);
      });
      function cartographit() {
              desiredFieldId = 'aide';
              desiredYear = '2013';
              field = fieldsById[desiredFieldId] || fields[0];
              deferredUpdate();
      }
    </script>
  </body>
</html>
