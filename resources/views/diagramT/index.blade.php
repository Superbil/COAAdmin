<!doctype html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>{{ trans('custom.page_title') }}</title>
    <!--Web default meta-->
    <meta name="robots" content="index, follow">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="{{ trans('custom.page_title') }}">
    <!--Web css-->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/animate_min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vowl.css') }}" rel="stylesheet">
    <!--Web Javascripts-->
    <script src="{{ asset('js/jquery-1.11.3.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/d3.v3.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/webVOWLGraph.js') }}" type="text/javascript"></script>

    <script>

     var svgControl=3;

     var graphTag = document.getElementById('graph')
       , linkDistanceClassLabel
       , linkDistanceLiteralLabel;

     var graphOptions = function graphOptionsFunct() {

       var resetOption = document.getElementById('resetOption'),
           sliderOption = document.getElementById('sliderOption');

       d3.select(resetOption)
         .append("button")
         .attr("id", "reset")
         .property("type", "reset")
         .text("Reset")
         .on("click", resetGraph);

       var slidDiv = d3.select(sliderOption)
                       .append("div")
                       .attr("id", "distanceSlider");

       linkDistanceClassLabel = slidDiv.append("label")
                                       .attr("for", "distanceSlider")
                                       .text(DEFAULT_VISIBLE_LINKDISTANCE);
       linkDistanceLiteralLabel = linkDistanceClassLabel;

       linkDistanceClassSlider = slidDiv.append("input")
                                        .attr("type", "range")
                                        .attr("min", 10)
                                        .attr("max", 600)
                                        .attr("value", DEFAULT_VISIBLE_LINKDISTANCE)
                                        .attr("step", 10)
                                        .on("input", changeDistance);
       linkDistanceLiteralSlider = linkDistanceClassSlider;
     };

     function query() {
       var url = location.href;

       //再來用去尋找網址列中是否有資料傳遞(QueryString)
       if (url.indexOf('?')!=-1) {
         //之後去分割字串把分割後的字串放進陣列中
         var ary1 = url.split('?');
         if (ary1[1].indexOf('(')!=-1) {
           var split=ary1[1].split('(');
           ary1[1]=split[0];
         }

       }
       var filter = decodeURI(ary1[1]);

       var sparql = d3.select("#sparql").property("value");
       var sparql2;
       var sparqlb = "FILTER regex (?Operation_labelX,'" + filter + "')}";
       var sparqlb3 = "FILTER regex (?Operation_label,'" + filter + "')}";
       var sparqlb2 = "FILTER ( ?S2 ='" + filter + "')FILTER ( ?Product_label = ?S )}";

       if (svgControl==1)
       {
         sparql2 = d3.select("#sparql2").property("value")
       }

       if (svgControl==2)
       {
         sparql2 = d3.select("#sparql3").property("value")
       }

       if (svgControl==3) {
         sparql2 = d3.select("#sparql2").property("value")
         var sparql3 = d3.select("#sparql3").property("value")
       }

       var url3 = "http://atb.bse.ntu.edu.tw/api/post/3";
       var mime = "application/sparql-results+json";

       d3.xhr(url3)
         .header("Content-Type", mime)
         .post(

           '{"sparql":"' + encodeURIComponent(sparql + sparqlb) + '&output=JSON'+'"}',

           function(err, rawData) {

             var json = rawData.responseText
             console.dir(json);

             var jsonp = JSON.parse(json)

             console.log("results.bindings");
             for (i=0; i < jsonp.results.bindings.length; i++) {
               console.log(jsonp.results.bindings[i]);
               jsonp.results.bindings[i]["X"]=1;
             }


             d3.xhr(url3)
               .header("Content-Type", mime)
               .post(
                 '{"sparql":"' + encodeURIComponent(sparql2 + sparqlb2) + '&output=JSON'+'"}',

                 function(err, rawData) {
                   console.log(rawData);

                   if (svgControl != 0) {
                     var json2 = rawData.responseText

                     console.log(json2);
                     var json2p = JSON.parse(json2)

                     for (i=0;i<json2p.results.bindings.length;i++)
                     {
                       console.log("GOOD2");
                       console.log(json2p.results.bindings[i]);
                       json2p.results.bindings[i]["X"]=2;
                     }

                     jsonp.results.bindings.push.apply(jsonp.results.bindings, json2p.results.bindings);
                     console.log(JSON.stringify(jsonp));
                   }

                   if (svgControl == 3) {
                     d3.xhr(url3)
                       .header("Content-Type", mime)
                       .post(
                         '{"sparql":"' + encodeURIComponent(sparql3+sparqlb3) + '&output=JSON' + '"}',

                         function(err, rawData) {
                           console.log(rawData);
                           if (svgControl != 0) {
                             var json3 = rawData.responseText

                             console.log(json3 );
                             var json3p = JSON.parse(json3)

                             for (i=0;i<json3p.results.bindings.length;i++)
                             {
                               console.log("GOOD3");
                               console.log(json3p.results.bindings[i]);
                               json3p.results.bindings[i]["X"]=3;
                             }

                             jsonp.results.bindings.push.apply(jsonp.results.bindings, json3p.results.bindings);
                             console.dir(jsonp);

                           }
                           /* render(jsonp) */
                           /* renderAtVOWL(jsonp); */
                           console.log("svgControl 3 Finish");
                         }
                       );

                   }

                   /* console.dir(jsonp) */
                   /* render(jsonp) */
                   renderAtVOWL(jsonp);
                 }
               );
           }
         );
     }
    </script>

  </head>

  <body id="page" class="resumeInq" onload="query()">
    <div id="navbar_top"> <a id="rwd_nav" href="#m_nav">
      <div class="ico"><span></span></div>
    </a> </div>

    <!--上版-->
    @include('partials.header')
    <main id="main">
      <div class="inner">

        <div id="graph">
          <div id="resetOption"></div>
          <div id="sliderOption"></div>
        </div>

        <div id="chart"></div>
        <div id="query" style="margin: 10px; display:none;">

          <h1 style="display:none">D3 forcegraph SPARQL</h1>
          <form class="form-inline">
            <label>SPARQL endpoint:</label>
            <div class="input-append">
              <input id="endpoint" class="span6" value="http://tgap.atb.bse.ntu.edu.tw/sparql" type="text">
              <button class="btn" type="button" onclick="query()">Query</button>
            </div>
          </form>

          <textarea id="sparql" class="span9" rows=15>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
            PREFIX tgap: <http://tgap.atb.bse.ntu.edu.tw/>
            SELECT DISTINCT  (coalesce(?X,?class) as ?Product)  (coalesce(?Product_labelX,?class) as ?Operation)  (coalesce(?Y,?class) as ?Product_label) (coalesce(?Product_labelX,?class) as ?Operation_label)  WHERE {
            ?ProductX tgap:uses ?OperationX  .

            ?ProductX rdfs:label ?Product_labelX .
            ?OperationX rdfs:label ?Operation_labelX .

            ?ProductX  tgap:process ?X  .
            ?X  rdfs:label ?Y .
          </textarea>

          <textarea id="sparql2" class="span9" rows=15>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
            PREFIX tgap: <http://tgap.atb.bse.ntu.edu.tw/>
            SELECT distinct (coalesce(?Product_label,?class) as ?Product)  ?Operation  ?Product_label ?Operation_label  WHERE {
            ?ProductX tgap:processLocation ?Operation  .
            ?ProductX rdfs:label ?Product_label .
            ?Operation rdfs:label ?Operation_label .
            ?ProductX  tgap:process ?X  .
            ?X  rdfs:label ?Y

            OPTIONAL {

            SELECT distinct (coalesce(?Product_label,?class) as ?S) (coalesce(?Operation_label,?class) as ?S2)   WHERE {
            ?ProductX tgap:uses ?Operation  .

            ?ProductX rdfs:label ?Product_label .
            ?Operation rdfs:label ?Operation_label .
            ?ProductX  tgap:process ?X  .
            ?X  rdfs:label ?Y .
            }

            }
          </textarea>


          <textarea id="sparql3" class="span9" rows=15>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
            PREFIX tgap: <http://tgap.atb.bse.ntu.edu.tw/>
            SELECT distinct (coalesce(?Product_label,?class) as ?Product)  ?Operation  ?Product_label ?Operation_label  WHERE {
            ?ProductX tgap:uses ?Operation  .

            ?ProductX rdfs:label ?Product_label .
            ?Operation rdfs:label ?Operation_label .
            ?ProductX  tgap:process ?X  .
            ?X  rdfs:label ?Y .
          </textarea>


        </div>
      </div>
    </main>
    <!--下版-->
    <footer id="footer">
      <div class="inner">
        <p>{{ trans('custom.sponsor') }}</p>
        <p>{{ trans('custom.maintain') }}</p>
        <p>{{ trans('custom.location') }}</p>
        <p>{{ trans('custom.service_line') }}：+886-2-33663468</p>
      </div>
    </footer>

    <script src="{{ asset('js/custom.js') }}" type="text/javascript"></script>

  </body>

</html>
