<?php
use adf\Config;
?>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title"><?= _l("adf.agent_list"); ?></h3>

          <!--
        <div class="box-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search"
              class="form-control pull-right" placeholder="Search">

            <div class="input-group-btn">
              <button type="submit" class="btn btn-default">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </div>
        </div>
        -->
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <table id="agent_list" class="table table-hover">
        <thead>
          <tr>
              <th>Name</th>
              <th>FullName</th>
              <th>Timestamp</th>
          </tr>
          </thead>
          <tbody>
                </tbody>
                <template id="agent_list_template">
                <tr>
                    <td class="agent_list_name"></td>
                    <td class="agent_list_fullname"></td>
                    <td class="agent_list_timestamp"></td>
                </tr>
                </template>
              </table>
      </div>
      <!-- /.box-body -->
      <div id="agent_list-overlay" class="overlay" style="display: none;">
      <i class="fa fa-refresh fa-spin"></i>
      </div>
    </div>
    <!-- /.box -->
    
  </div>
</div>


<script>
document.addEventListener("adf_add_agent", function(){
  //alert("custom event fire!!");
	getAgentList();
}, false);

$(function(){
  getAgentList();
});

function getAgentList(){

	$('#agent_list-overlay').show();
  
	fetch('<?= Config::$TOP_PATH ?>agents_get', {
        method: 'GET'
      })
      .then(function(response) {
        return response.json()
      })
      .then(function(json) {
          
        $('#agent_list-overlay').hide();
        
        setTableData(json);

      });
}

function setTableData(data)
{

    var tb = document.querySelector('#agent_list tbody');
    while (child = tb.lastChild)
    { tb.removeChild(child); }

    for(var i=0;i<data.length;i++)
    {
        var t = document.querySelector('#agent_list_template');

        t.content.querySelector('.agent_list_name').textContent = data[i]['alias'];
        t.content.querySelector('.agent_list_fullname').textContent = data[i]['name'];
        t.content.querySelector('.agent_list_timestamp').textContent = data[i]['timestamp'];
        //t.content.querySelector('a').href = '<?= Config::$TOP_PATH ?>agent/'+data[i]['uuid'];
        /*
        if(data[i]['status'])
        {
            t.content.querySelector('.agent_list_status').classList.add('label-success');
            t.content.querySelector('.agent_list_status').classList.remove('label-danger');
            t.content.querySelector('.agent_list_status').textContent = 'Approved';
        }else{
            t.content.querySelector('.agent_list_status').classList.add('label-danger');
            t.content.querySelector('.agent_list_status').classList.remove('label-success');
            t.content.querySelector('.agent_list_status').textContent = 'Invalid';
        }
        */

        var clone = document.importNode(t.content, true);
        tb.appendChild(clone);
    }

}

</script>
