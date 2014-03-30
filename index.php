<html>
	<head>
		<title>WTB</title>
		<style type="text/css" title="currentStyle">
			@import "css/demo_page.css";
			@import "css/demo_table.css";
		</style>
		<script type='text/javascript' src="js/jquery-2.1.0.min.js"></script>
		<script type='text/javascript' src="js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
                //$('#tbl').dataTable();
                $('#tbl').dataTable({
                    "bProcessing" : true,
                    "bServerSide" : true,
                    // 数据源
                    "sAjaxSource" : "q1.php",
                    // 传递参数进入php
                    "fnServerParams" : function(aoData) {
                        aoData.push({
                            "name" : "my_arg",
                            "value" : "my_value"
                        });
                    },
                    // 格式化输出
                    "aoColumnDefs" : [{
                        "mData" : "idwtb",
                        "aTargets" : [0]
                    },{
                        "mData" : "item_name",
                        "aTargets" : [1]
                    }, {
                        "mData" : "play_name",
                        "aTargets" : [2]
                    }, {
                        "mData" : "c",
                        "aTargets" : [3],
                        "mRender" : function(data, type, full) {
                            // 'full' is the row's data object, and 'data' is this column's data
                            // e.g. 'full[0]' is the comic id, and 'data' is the comic title
                            return parseInt(data).toLocaleString();
                        }
                    }, {
                        "mData" : "hath",
                        "aTargets" : [4]
                    }, {
                        "mData" : "num_want",
                        "aTargets" : [5]
                    }, {
                        "mData" : "src",
                        "aTargets" : [6],
                        "mRender" : function(data, type, full) {
                            // 'full' is the row's data object, and 'data' is this column's data
                            // e.g. 'full[0]' is the comic id, and 'data' is the comic title
                            return '<a href="' + data + '">link</a>';
                        }
                    }]
                });
            });
		</script>
	</head>
	<h1>Want To Buy Table</h1>
	<label>json format data : q1.php </label>
	<label><a href="insert.html">Add My Order</a></label>
	<table id="tbl" cellpadding="0" cellspacing="0" border="1" class="display" width="100%">
		<thead>
			<tr>
				<th width="5%">ID</th>
				<th width="18%">item_name</th>
				<th width="16%">player_name</th>
				<th width="10%">c</th>
				<th width="5%">hath</th>
				<th width="5%">num_want</th>
				<th>src</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="7" class="dataTables_empty">Loading data from server</td>
			</tr>
		</tbody>
	</table>
	</body>
</html>