<html>
<head>
<title>connect.php</title>
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
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "q1.php",
		"aoColumns": [
            { "mData": "item_name" },
            { "mData": "play_name" },
            { "mData": "c" },
            { "mData": "hath" },
            { "mData": "num_want"},
            { "mData": "src"}],
	});
});
</script>
</head>
<h1>Want To Buy Table</h1>
<table id="tbl" cellpadding="0" cellspacing="0" border="1" class="display" width="100%">
<thead>
		<tr>
			<th>item_name</th>
			<th>play_name</th>
			<th>c</th>
			<th>hath</th>
			<th>num_want</th>
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
