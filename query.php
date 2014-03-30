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
                    "sAjaxSource" : "q1.php",
                    "aoColumns" : [{
                        "mData" : "item_name"
                    }, {
                        "mData" : "play_name"
                    }, {
                        "mData" : "c"
                    }, {
                        "mData" : "hath"
                    }, {
                        "mData" : "num_want"
                    }, {
                        "mData" : "src"
                    }],
                    "aoColumnDefs" : [{
                        "aTargets" : [0],
                        "mData" : function(source, type, val) {
                            if (type === 'set') {
                                source.price = val;
                                // Store the computed dislay and filter values for efficiency
                                source.price_display = val == "" ? "" : "$" + numberFormat(val);
                                source.price_filter = val == "" ? "" : "$" + numberFormat(val) + " " + val;
                                return;
                            } else if (type === 'display') {
                                return source.price_display;
                            } else if (type === 'filter') {
                                return source.price_filter;
                            }
                            // 'sort', 'type' and undefined all just use the integer
                            return source.price;
                        }
                    }]
                });
            });
		</script>
	</head>
	<h1>Want To Buy Table</h1>
	<label>json format data : q1.php </label>
	<table id="tbl" cellpadding="0" cellspacing="0" border="1" class="display" width="100%">
		<thead>
			<tr>
				<th width="18%">item_name</th>
				<th width="16%">play_name</th>
				<th width="10%">c</th>
				<th width="5%">hath</th>
				<th width="5%">num_want</th>
				<th>src</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="6" class="dataTables_empty">Loading data from server</td>
			</tr>
		</tbody>
	</table>
	</body>
</html>