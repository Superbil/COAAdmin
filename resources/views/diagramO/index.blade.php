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
    

    <script src="/js/d3.v3.min.js"></script>
    <script>

    var svg;
    var svgControl=0;
    var filterControl=0;
    var filter;

    function query() {
       



     var url = location.href;

     //再來用去尋找網址列中是否有資料傳遞(QueryString)
     if(url.indexOf('?')!=-1)
     {
     //之後去分割字串把分割後的字串放進陣列中
     var ary1 = url.split('?');
     //此時ary1裡的內容為：
     //ary1[0] = 'index.aspx'，ary2[1] = 'id=U001&name=GQSM'
   // decodeURI(encoded)
    // alert(decodeURI(ary1[1]));
    
     }
       if(filterControl==0)     
       {
       filter = decodeURI(ary1[1]);
       }
      var endpoint = d3.select("#endpoint").property("value")
      var sparql = d3.select("#sparql").property("value")
      var sparql2;
    //  var sparqlb = "FILTER regex (?Product_label,'" +decodeURI(ary1[1])+ "')}"
    //  var sparqlb2 = "FILTER regex (?Y,'" +decodeURI(ary1[1])+ "')}"

      var sparqlb = "FILTER regex (?Operation_label,'" +filter+ "')}"
      var sparqlb2 = "FILTER regex (?Product_label,'" +filter+ "')}"
      var sparqlb3 = "FILTER regex (?Product_label,'" +filter+ "')}"
    //  alert(sparql+sparqlb);
     if (svgControl==1)
      {  
      sparql2 = d3.select("#sparql2").property("value")
      }

     if (svgControl==2)
      {  
     sparql2 = d3.select("#sparql3").property("value")
      }

      if (svgControl==3)
      {  
       sparql2 = d3.select("#sparql2").property("value")
      var sparql3 = d3.select("#sparql3").property("value")
      }
     //  alert(sparql2+sparqlb2);
      var url = endpoint + "?query=" + encodeURIComponent(sparql+sparqlb) + "&output=JSON"
      var url2 = endpoint + "?query=" + encodeURIComponent(sparql2+sparqlb2) + "&output=JSON"
      var url3 = "http://140.112.76.152/api/post/3"
      var url4 = "http://140.112.76.152/api/post/3"
      var url5 = "http://140.112.76.152/api/post/3"
      var mime = "application/sparql-results+json"
      var mime2 = "application/sparql-results+json"
      var mime3 = "application/sparql-results+json"
      var mime4 = "application/sparql-results+json"
      var mime5 = "application/sparql-results+json"
      var json = null
      var json2 = null
      var json3 = null
      var jsonp = null
      var json2p = null
      var json3p = null
      var GO = []
        console.log(url );
          console.log(url2 );
      d3.xhr(url3)
    .header("Content-Type", mime3)
    .post(

'{"sparql":"'+encodeURIComponent(sparql+sparqlb)+ '&output=JSON'+'"}'

        ,
        function(err, rawData){
              
           console.log(rawData );
           json = rawData.responseText
         console.log(json );
         jsonp = JSON.parse(json)
             console.log("ya");

          for (i=0;i<jsonp.results.bindings.length;i++)	
         {	
         console.log("GOOD");	
         console.log(jsonp.results.bindings[i]);	
         jsonp.results.bindings[i]["X"]=1;	
         }


        d3.xhr(url4)
    .header("Content-Type", mime4)
    .post(

'{"sparql":"'+encodeURIComponent(sparql2+sparqlb2)+ '&output=JSON'+'"}'

        ,
        function(err, rawData){
               console.log(rawData );
         if (svgControl!=0)
         {  
           json2 = rawData.responseText
           
         console.log(json2 );
         json2p = JSON.parse(json2)

         for (i=0;i<json2p.results.bindings.length;i++)	
         {	
         console.log("GOOD2");	
         console.log(json2p.results.bindings[i]);	
         json2p.results.bindings[i]["X"]=2;	
         }
     
         jsonp.results.bindings.push.apply(jsonp.results.bindings,json2p.results.bindings)
         console.log(JSON.stringify(jsonp));

         }







                 if (svgControl==3)
                 {  
                  d3.xhr(url5)
                 .header("Content-Type", mime5)
                 .post(

                 '{"sparql":"'+encodeURIComponent(sparql3+sparqlb3)+ '&output=JSON'+'"}'

                  ,
                  function(err, rawData){
                  console.log(rawData );
                  if (svgControl!=0)
                  {  
                  json3 = rawData.responseText
           
                  console.log(json3 );
                  json3p = JSON.parse(json3)

                  for (i=0;i<json3p.results.bindings.length;i++)	
                  {	
                  console.log("GOOD3");	
                  console.log(json3p.results.bindings[i]);	
                  json3p.results.bindings[i]["X"]=3;	
                  }
     
                  jsonp.results.bindings.push.apply(jsonp.results.bindings,json3p.results.bindings)
                   console.log(JSON.stringify(jsonp));

                  }
                  render(jsonp)
                  console.log("yayaya");
                  }
                 );

                 }












                console.log(JSON.stringify(jsonp));



              render(jsonp)
             console.log("ya");
        }
    );

    


        }
    );
  
      /*d3.xhr(url, mime, function(request) {
         json = request.responseText
         console.log(json );
         jsonp = JSON.parse(json)
        d3.xhr(url2, mime2, function(request2) {
         json2 = request2.responseText
          console.log(json2 );
         json2p = JSON.parse(json2)
         jsonp.results.bindings.push.apply(jsonp.results.bindings,json2p.results.bindings)
         console.log(JSON.stringify(jsonp));
         render(jsonp)
         })
      })*/
      
     
    }
    function render(json) {
      var config = {
        "key1": "Product",
        "key2": "Operation",
        "key3": "X",
        "label1": "Product_label",
        "label2": "Operation_label",
      }
      var graph = sparql2graph(json, config)
      var option = {
        "radius": 10,
        "charge": -200,
        "distance": 50,
        "width": 1000,
        "height": 750,
      }
      var option2 = {
        "radius": 10,
        "charge": -200,
        "distance": 200,
        "width": 1000,
        "height": 750,
      }
       var jsonLength=0;
       for (var i in json.results.bindings)
       {jsonLength++;}
       console.log(jsonLength);
      if(jsonLength>50)
      {
      d3forcegraph(graph, option2)
      }
      else
      {
      d3forcegraph(graph, option2)
      }
    }
    function sparql2graph(json, config) {
      var data = json.results.bindings
      var graph = {
        "nodes": [],
        "links": []
      }
      var check = d3.map()
      var index = 0
       
      for (var i = 0; i < data.length; i++) {
        var key1 = data[i][config.key1].value
        var key2 = data[i][config.key2].value
        var key3 = data[i][config.key3]
        var label1 = config.label1 ? data[i][config.label1].value : key1
        var label2 = config.label2 ? data[i][config.label2].value : key2
        if (!check.has(key1)) {
          graph.nodes.push({"key": key1, "label": label1 , "group": key3})
          check.set(key1, index)
          index++
        }
        if (!check.has(key2)) {
          graph.nodes.push({"key": key2, "label": label2 , "group": key3+1})
          check.set(key2, index)
          index++
        }
        graph.links.push({"source": check.get(key1), "target": check.get(key2)})
      }
      return graph
    }
    function d3forcegraph(json, config) {
      if(svgControl==2)
      {
       var color = d3.scale.category10()   	
      .range(['#1f77b4', '#ff7f0e', '#d62728', '#2ca02c', '#9467bd', '#8c564b']);
      }	
      else
      {
       var color = d3.scale.category10();
      }
      console.log(color);
        //if (svgControl==1)
        //{
        d3.select("svg").remove();
        //}
        svg = d3.select("#chart")
        .append("svg")
        .attr("width", config.width)
        .attr("height", config.height)
      var link = svg.selectAll(".link")
        .data(json.links)
        .enter()
        .append("line")
        .attr("class", "link")
        .style("marker-end",  "url(#suit)") 
      var node = svg.selectAll(".node")
        .data(json.nodes)
        .enter()
        .append("g")
        .on("click", function(d){
           if (d.group==2)
           {
           if (svgControl==0)
           {
           svgControl=1;
           alert("切換(施作類型)");
           query();
           }
           else if (svgControl==1)
           {
           svgControl=2;
           alert("切換(工具類型)");
           query();
           }
           else if (svgControl==2) { 
           svgControl=3;
           //alert("切換(施作地點)"+d.group);
           alert("切換(施作地點)(工具類型)");
           query();
           }
           else if (svgControl==3) { 
           svgControl=0;
           //alert("切換(施作地點)"+d.group);
           alert("切換(原始圖)");
           query();
           }
           else 
           {
           svgControl=0;
           //alert("切換(施作地點)"+d.group);
           alert("切換(施作地點)");
           query();
           }
           }


            if (d.group==1)
           {
             alert("無法切換(本查詢只有此一型態)");
           }
            /*if (d.group==1)
           {
            if (filterControl==0)
           {
           svgControl=0;
           filterControl=1;
           //alert("切換(原始圖)"+d.group);
           alert("切換(查詢)"+d3.select(this).select("text").text());
           //filter=d3.select(this).select("text").text();
           query();
           }else
           {
            svgControl=0;
           filterControl=0;
           //alert("切換(原始圖)"+d.group);
           alert("切換(原始圖)");
           //filter="";
           query();
           }
           }*/
          // alert(svgControl);
          
            
            
          //query2();
        })
        .style("fill", function (d) {	
        return color(d.group);	
        })
        .attr("group", function(d) {return d.group})
        .style("cursor", "pointer"); 






       var drag = d3.behavior.drag();
       drag.on("dragend", function() {
       d3.event.sourceEvent.stopPropagation(); // silence other listeners
       });
      var circle = node.append("circle")
        .attr("class", "node")
        .attr("r", config.radius)
      var text = node.append("text")
        .text(function(d) {return d.label})
        .attr("class", "node")
      var force = d3.layout.force()
        .charge(config.charge)
        .linkDistance(config.distance)
        .size([config.width, config.height])
        .nodes(json.nodes)
        .links(json.links)
        .start()
      force.on("tick", function() {
        link.attr("x1", function(d) {return d.source.x})
            .attr("y1", function(d) {return d.source.y})
            .attr("x2", function(d) {return d.target.x})
            .attr("y2", function(d) {return d.target.y})
        text.attr("x", function(d) {return d.x})
            .attr("y", function(d) {return d.y})
        circle.attr("cx", function(d) {return d.x})
              .attr("cy", function(d) {return d.y})
      })
      
        //---Insert-------	
      svg.append("defs").selectAll("marker")	
     .data(["suit", "licensing", "resolved"])	
     .enter().append("marker")	
     .attr("id", function(d) { return d; })	
     .attr("viewBox", "0 -5 10 10")	
     .attr("refX", 25)	
     .attr("refY", 0)	
     .attr("markerWidth", 6)	
     .attr("markerHeight", 6)	
     .attr("orient", "auto")	
     .append("path")	
     .attr("d", "M0,-5L10,0L0,5 L10,0 L0, -5")	
     .style("stroke", "#4679BD")	
     .style("opacity", "0.6");   
   
      node.call(force.drag)
    }
    </script>
     <style>
    .link {
      stroke: #999;
    }
    .node {
      stroke: black;
      opacity: 0.5;
    }
    circle.node {
      stroke-width: 1px;
      //fill: RoyalBlue;
    }
    text.node {
      font-family: "sans-serif";
      font-size: 8px;
    }
    </style>
    
</head>

<body id="page" class="resumeInq" onload="query()">
    <div id="navbar_top"> <a id="rwd_nav" href="#m_nav">
            <div class="ico"><span></span></div>
        </a> </div>
    <!--上版-->
    @include('partials.header')
    <main id="main">
        <div class="inner">
        <div id="chart"></div>
            <div id="query" style="margin: 10px">
      <h1 style="display:none">D3 forcegraph SPARQL</h1>
      <form class="form-inline">
        <label style="display:none">SPARQL endpoint:</label>
        <div class="input-append">
          <input id="endpoint" class="span6" value="http://tgap.atb.bse.ntu.edu.tw/sparql" type="text" style="display:none">
          <button class="btn" type="button" onclick="query()" style="display:none">Query</button>
        </div>
      </form>
      <textarea id="sparql" class="span9" rows=15 style="display:none">
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
PREFIX tgap: <http://tgap.atb.bse.ntu.edu.tw/>
SELECT ?Product  (coalesce(?Operation_label,?class) as ?Operation)  ?Product_label ?Operation_label  WHERE {
   ?Product  tgap:isProcessedBy  ?OperationX  .
   ?Product  rdfs:label ?Product_label .
   ?OperationX rdfs:label ?Operation_label .
      </textarea>

<textarea id="sparql2" class="span9" rows=15 style="display:none">
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
PREFIX tgap: <http://tgap.atb.bse.ntu.edu.tw/>
SELECT (coalesce(?Product_label,?class) as ?Product)  ?Operation  ?Product_label ?Operation_label ?X ?Y WHERE {
   ?ProductX tgap:processLocation ?Operation  .
  
   ?ProductX rdfs:label ?Product_label .
   ?Operation rdfs:label ?Operation_label .
    ?ProductX  tgap:process ?X  .
   ?X  rdfs:label ?Y .
   
  
      </textarea>


<textarea id="sparql3" class="span9" rows=15 style="display:none">
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
PREFIX tgap: <http://tgap.atb.bse.ntu.edu.tw/>
SELECT (coalesce(?Product_label,?class) as ?Product)  ?Operation  ?Product_label ?Operation_label ?X ?Y WHERE {
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
    <script src="https://unpkg.com/jquery" charset="utf-8"></script>
    <script src="{{ asset('js/custom.js') }}" type="text/javascript"></script>
    
    
    
</body>

</html>
