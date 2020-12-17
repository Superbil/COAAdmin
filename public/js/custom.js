//手機三條線選單
$(document).ready(function() {
    $("#rwd_nav").click(function() {
        $("#m_nav .bars_close").show();
        $(this).toggleClass("active");
    });
    $("#m_nav .bars_close").click(function() {
        $("#rwd_nav").removeClass("active");
    });
});
//搬移
$(document).ready(function() {
    rwd_fun();
    $(window).resize(rwd_fun);
});

function rwd_fun() {
    var width = window.innerWidth;
    var height = window.innerHeight;
    if (width >= 1024) {
        $('#header_nav').before($('#header_logo'));
    } else {
        $('#rwd_nav').before($('#header_logo'));
    }
}

$(document).ready(function(){
    $('#m_nav a:lt(3)').click(function(){
        $("#rwd_nav").removeClass("active");
        $("#m_nav .bars_close").hide();
        $.pageslide.close();
    });
    $("#togBtn").change(function(){
        if(this.checked){
            //console.log('en');
            location.href="/locales/en";
        }
        else{
            //console.log('zhtw');
            location.href="/locales/zhtw";
        }
    });
})

function renderAtVOWL(json) {
  var height = 600, width = 1000;
  var graphElement = document.getElementById('graph');

  var config = {
    "key1": "Product",
    "key2": "Operation",
    "key3": "X",
    "label1": "Product_label",
    "label2": "Operation_label",
  }
  var graph = sparql2graph(json, config);

  console.log('renderAtVOWL');
  console.dir(graph);
  if (graph === undefined) { return; }
  drawGraph(graphElement, width, height, graph);
}

function sparql2graph(json, config) {
  if (json === undefined || json.results.bindings === undefined) {
    console.log('no json.results.bindings');
    return;
  }

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
      graph.nodes.push({
        "key": key1,
        "name": label1,
        "group": key3,
        "type": "class"
      })
      check.set(key1, index)
      index++
    }
    if (!check.has(key2)) {
      graph.nodes.push({
        "key": key2,
        "name": label2,
        "group": key3 + 1,
        "type": "class"
      })
      check.set(key2, index)
      index++
    }
    graph.links.push({
      "source": check.get(key1),
      "target": check.get(key2)
    })
  }
  return graph
}
