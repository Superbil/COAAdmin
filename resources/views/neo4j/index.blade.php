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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/popoto/dist/popoto.min.css">
    <link rel="stylesheet" type="text/css" href="css/vowl.css"/>
    <link rel="stylesheet" type="text/css" href="css/pagestyle.css"/>
    <!--Web Javascripts-->
    <script src="{{ asset('js/specBrowserWarning.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/d3.v3.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery-1.11.3.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/webVOWLGraph.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/specVOWL.js') }}" type="text/javascript"></script>

    <style>
     #popoto-graph:fullscreen {
         width: 100%;
         height: 100%;
     }

     #popoto-graph:-webkit-full-screen {
         width: 100%;
         height: 100%;
     }

     #popoto-graph:-moz-full-screen {
         width: 100%;
         height: 100%;
     }

     #popoto-graph:-ms-fullscreen {
         width: 100%;
         height: 100%;
     }
     .ppt-taxo-ul .ppt-label{
         color: white;
     }
    </style>
  </head>

  <body id="page" class="resumeInq">
    <div id="navbar_top"> <a id="rwd_nav" href="#m_nav">
      <div class="ico"><span></span></div>
    </a> </div>
    <!--上版-->
    @include('partials.header')
    <main id="main">
      <div class="inner">
        <div id="wrapper">

          <section id="example">

            <div id="graph">
              <div id="resetOption"></div>
              <div id="sliderOption"></div>
            </div>

          </section>

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

    <script>
     /**
      * URL used to access Neo4j REST API to execute queries.
      * Update this parameter to your running server instance.
      *
      * For more information on Neo4J REST API the documentation is available here: http://neo4j.com/docs/stable/rest-api-cypher.html
      */
     popoto.rest.CYPHER_URL = "{{env('CYPHER_URL')}}";
     /**
      * Add this authorization property if your Neo4j server uses basic HTTP authentication.
      * The value of this property must be "Basic <payload>", where "payload" is a base64 encoded string of "username:password".
      *
      * "btoa" is a JavaScript function that can be used to encode the user and password value in base64 but it is recommended to directly use the Base64 value.
      *
      *  For example Base64 encoded value of "neo4j:password" is "bmVvNGo6cGFzc3dvcmQ="
      *  Note that it is not a safe way to keep credentials as anyone can have access to this code in your web page.
      */
     popoto.rest.AUTHORIZATION = "Basic " + btoa("{{env('AUTHORIZATION')}}");
     /**
      * Define the Label provider you need for your application.
      * This configuration is mandatory and should contain at least all the labels you could find in your graph model.
      *
      * In this version only nodes with a label are supported.
      *
      * By default If no attributes are specified Neo4j internal ID will be used.
      * These label provider configuration can be used to customize the node display in the graph.
      * See www.popotojs.com or example for more details on available configuration options.
      */
     popoto.provider.node.Provider = {
       "出貨": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "品種": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true // if set to true Person nodes will be automatically expanded in graph
       },
       "器具": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "地點": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "基肥": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "工作": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "工具": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "成分": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "特性": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "環境友善資材": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "生物防治資材": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "產品": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true // if set to true Person nodes will be automatically expanded in graph
       },
       "發酵分類": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "茶產品": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "設備": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "農場": {
         "returnAttributes": ["name", "city"],
         "constraintAttribute": "name",
         "autoExpandRelations": true // if set to true Person nodes will be automatically expanded in graph
       },
       "農民": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "農藥快篩結果": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "進貨": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "雜草防除方式": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "AccessoryElement": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "Crop": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "Disease": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "EssentialElement": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "Factory": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "Farmer": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "Fertilizer": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "Field": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "GrowingPhase": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "MajorElement": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "MicroElement": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "NonEssentialElement": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "Operation": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "Period": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "Pest": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "Producer": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "Result": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "RiceProcessing": {
         "returnAttributes": ["name"],
         "constraintAttribute": "name",
         "autoExpandRelations": true
       },
       "說明": {
         "returnAttributes": ["text"],
         "constraintAttribute": "text",
         "autoExpandRelations": true
       }

     };
     /**
      * Here a listener is used to retrieve the total results count and update the page accordingly.
      * This listener will be called on every graph modification.
      */
     popoto.result.onTotalResultCount(function (count) {
       document.getElementById("result-total-count").innerHTML = "(" + count + ")";
     });
     /**
      * The number of results returned can be changed with the following parameter.
      * Default value is 100.
      *
      * Note that in this current version no pagination mechanism is available in displayed results
      */
     popoto.query.RESULTS_PAGE_SIZE = 100;
     /**
      * For this version, popoto.js has been generated with debug traces you can activate with the following properties:
      * The value can be one in DEBUG, INFO, WARN, ERROR, NONE.
      *
      * With INFO level all the executed cypher query can be seen in the navigator console.
      * Default is NONE
      */
     popoto.logger.LEVEL = popoto.logger.LogLevels.INFO;
     /**
      * Start popoto.js generation.
      * The function requires the label to use as root element in the graph.
      */
     popoto.start("農場");
    </script>
  </body>

</html>
