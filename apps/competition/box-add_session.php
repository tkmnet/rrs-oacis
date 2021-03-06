<?php
use adf\Config;
?>
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Add Session</h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
     </div>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form id="add_parameter-form" action="./competition-add_session" method="POST"
    class="form-horizontal" enctype="multipart/form-data">
    <div class="box-body">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="parameter_name" placeholder="name" required>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Agents</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="parameter_agents"
            placeholder="sample1,sample2,sample3"
            value="<?= $agentAliasText ?>"
            required>
        </div>
      </div>
        <div class="form-group">
            <label for="precursor" class="col-sm-2 control-label">Precursor</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="parameter_precursor"
                       placeholder='precursor session (like "Day1")'>
            </div>
        </div>
        <div class="form-group">
            <label for="highlight" class="col-sm-2 control-label">Highlight</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="parameter_highlight"
                       placeholder='number of highlight (3 or less the ranking mode)'>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <!-- <button type="submit" class="btn btn-default">キャンセル</button> -->
      <button type="submit" class="btn btn-primary pull-right"><?= _l("adf.add_agent_box.input_add"); ?></button>
    </div>
    <!-- /.box-footer -->
    <input type="hidden" name="action" value="create">
  </form>
  <div id="add_parameter-form-overlay" class="overlay" style="display: none;">
    <i class="fa fa-refresh fa-spin"></i>
  </div>
</div>
<!-- /.box -->

<script>

$(".readonly").keydown(function(e){
    e.preventDefault();
});
  $('input[id=lefile]').change(function() {
    $('#photoCover').val($(this).val());
  });

  
  $("#add_parameter-form").submit(function(e){
      $('#add_parameter-form-overlay').show();
      $("#add_parameter-form").submit();
	 });

  //inputのList
  
  document.addEventListener("adf_add_agent", function(){
    getAgentParameterList();
  }, false);

  document.addEventListener("adf_add_map", function(){
	    getAgentParameterList();
  }, false);

  
$(function(){
    // 処理
    getAgentParameterList();
    getMapParameterList();
      
});

function getAgentParameterList(){

	fetch('<?= Config::$TOP_PATH ?>agents_get', {
        method: 'GET'
      })
      .then(function(response) {
        return response.json()
      })
      .then(function(json) {
          
        setAgentListOptionData(json);

      });
    
}



function setAgentListOptionData(date){

    var tb = document.querySelector('#agent_keyword');
    while (child = tb.lastChild) tb.removeChild(child);

    for(var i=0;i<date.length;i++){
      
      
      var t = document.querySelector('#agent_keyword_option');
      
      t.content.querySelector('option').value = date[i]['name'] +'_'+ date[i]['uuid'];

      var clone = document.importNode(t.content, true);
      tb.appendChild(clone);
      }
      
}

//Map
function getMapParameterList(){

  fetch('<?= Config::$TOP_PATH ?>maps_get', {
        method: 'GET'
      })
      .then(function(response) {
        return response.json()
      })
      .then(function(json) {
          
        setMapListOptionData(json);

      });
    
}



function setMapListOptionData(date){

    var tb = document.querySelector('#map_keyword');
    while (child = tb.lastChild) tb.removeChild(child);

    for(var i=0;i<date.length;i++){
      
      
      var t = document.querySelector('#map_keyword_option');
      
      t.content.querySelector('option').value = date[i]['name'] +'_'+ date[i]['uuid'];

      var clone = document.importNode(t.content, true);
      tb.appendChild(clone);
      }
      
}
  
</script>
