<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include_once 'languages.php'; ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo _("New order");?></title>
		<style type="text/css" title="currentStyle">
			@import "css/demo_page.css";
			@import "css/demo_table.css";
			@import "css/demos.css";
			@import "css/jquery.dataTables.css";
			@import "css/jquery.dataTables_themeroller.css";
			@import "css/themes/base/jquery.ui.all.css";
		</style>
		<link rel="icon" href="favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="css/themes/base/jquery.ui.all.css">
		<link rel="stylesheet" href="css/demos.css">
		<script type='text/javascript' src="js/jquery-2.1.0.min.js"></script>
		<script type='text/javascript' src="js/jquery.dataTables.min.js"></script>
		<script src="js/ui/jquery.ui.core.js"></script>
		<script src="js/ui/jquery.ui.widget.js"></script>
		<script src="js/ui/jquery.ui.mouse.js"></script>
		<script src="js/ui/jquery.ui.draggable.js"></script>
		<script src="js/ui/jquery.ui.position.js"></script>
		<script src="js/ui/jquery.ui.resizable.js"></script>
		<script src="js/ui/jquery.ui.button.js"></script>
		<script src="js/ui/jquery.ui.dialog.js"></script>
		<script src="js/ui/jquery.ui.spinner.js"></script>
		<script src="js/ui/jquery.ui.menu.js"></script>
		<script src="js/ui/jquery.ui.autocomplete.js"></script>
		<script type='text/javascript' src="js/ui/jquery.ui.tooltip.js"></script>
		<script type='text/javascript' src="js/external/jquery.mousewheel.js"></script>
		<script type='text/javascript' src="js/external/globalize.js"></script>
		<style>
			#toolbar {
				padding: 4px;
				display: inline-block;
			}
			/* support: IE7 */
			*+ html #toolbar {
				display: inline;
			}
			/* 自动完成等待图标 */
			.ui-autocomplete-loading {
				background: white url('images/ui-anim_basic_16x16.gif') right center no-repeat;
			}
		</style>

		<script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
				// 自动完成 --物品名称
				$( "#item" ).autocomplete({
					selectFirst: true,
					autoFocus: true , //自动聚焦到第一个
					minLength: 3, // 最小触发长度
					// 数据源
					source: function( request, response ) {
						$.ajax({
							url: "qitem.php",
							dataType: "json",
							data: {
								term: request.term
							},
							// 绑定数据
							success: function( data ) {
								//没有找到此物品
								if (data.adata.length == 0) {
									$("#item_id")[0].textContent="";
									$("#item").autocomplete("close");
								}
								// 找到了,显示出来
								response($.map(data.adata, function( item ) {
									return {
										id: item.iditem, // 这个呢?
										label: item.item_name, //显示在弹出层
										value: item.item_name //点击填写到文本框
									}
								}));
							}
						});
					},
					// 点击选择时触发
					select: function( event, ui ) {
						$("#item_id")[0].textContent=ui.item.id;
					},
					focus: function (event, ui) {
						$("#item_id")[0].textContent=ui.item.id;
						return true;
                    },
					open: function() {
						$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
					},
					close: function() {
						$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
					}
				});
				// 自动完成 -- 玩家名称
				$( "#player" ).autocomplete({
					selectFirst: true,
					autoFocus: true , //自动聚焦到第一个
					minLength: 2, // 最小触发长度
					// 数据源
					source: function( request, response ) {
						$.ajax({
							url: "qplayer.php",
							dataType: "json",
							data: {
								term: request.term
							},
							// 绑定数据
							success: function( data ) {
								//没有找到此用户
								if (data.adata.length == 0) {
									$("#player_id")[0].textContent="";
									$("#player").autocomplete("close");
									// 是否让用户确认添加?待定
									//if (confirm('未找到该用户,是否添加?\nNot found this player.Add a new one?')) {
										// 弹出添加用户
										$("#dialog").dialog("open");
										$("#name")[0].value=$("#player")[0].value;
										$("#id")[0].value="";
									//}
								}
								// 找到了,显示出来
								response($.map(data.adata, function( item ) {
									return {
										id: item.idplay, // 这个呢?
										label: item.play_name, //显示在弹出层
										value: item.play_name //点击填写到文本框
									}
								}));
							}
						});
					},
					// 点击选择时触发
					select: function( event, ui ) {
						$("#player_id")[0].textContent=ui.item.id;
					},
					focus: function (event, ui) {
						$("#player_id")[0].textContent=ui.item.id;
						return true;
                    },
					open: function() {
						$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
					},
					close: function() {
						$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
					}
				});
				$( "#radio" ).buttonset();
                $(".nb").spinner({
					min : 0,
                    numberFormat: "n0"
                });
                $("#c").spinner({
                    min : 0,
					step: 1000,
					numberFormat: "n0"
                });
				$("#hath").spinner({
                    min : -1,
					numberFormat: "n0"
                });
                $(".btn").button();
                $("#add_player").button({
                    text : false,
                    icons : {
                        primary : "ui-icon-circle-plus"
                    }
                }).click(function() {
                    $("#dialog").dialog("open");
                });
				// 增加用户ajax.
                $("#btnAdd").button({
                    text : false
                }).click(function() {
					if($("#id")[0].value=="" || $("#name")[0].value=="" ){
						alert('idplay/name is void!\n名字或id不能为空');
						return false;				
					}
                    $.ajax({
		                type : "post",
		                url : "addplayer.php",
		                contentType : "application/x-www-form-urlencoded; charset=utf-8",
		                dataType : "text",
		                data : "id="+ $("#id")[0].value+"&name="+$("#name")[0].value,
		                beforeSend : function(XMLHttpRequest) {
		                    //alert("提交");
		                    $("#wait")[0].textContent = "waitng";
							$("#player")[0].value="";
							$("#player_id")[0].textContent="";
		                },
		                //成功(先成功,后完成)
		                success : function(data, textStatus) {
							//alert(data);
							$("#player")[0].value=$("#name")[0].value;
							$("#player_id")[0].textContent=$("#id")[0].value;
		                    $("#wait")[0].textContent = "OK";
							$("#dialog").dialog("close");
		                },
		                error : function(XMLHttpRequest, textStatus, errorThrown) {
							$("#player")[0].value="";
							$("#player_id")[0].textContent="";
		                    $("#wait")[0].textContent = "ERR";
		                    alert("ERR:" + XMLHttpRequest.responseText);
		                },
						complete:function(XHR, TS){
						}
		            });
                });
				// 取消添加用户
                $("#btnCal").click(function() {
                    $("#dialog").dialog("close");
                });
                $("#home").button({
                    icons : {
                        primary : "ui-icon-home"
                    }
                }).click(function() {
                    top.location.href = "/index.php?lang=<?php echo _("en_US");?>";
                });
				// 添加交易条目
                $("#submit").button({
                    icons : {
                        primary : "ui-icon-check"
                    }
                }).click(function() {
                    // 点击事件
					if($("#item_id")[0].textContent=="" || $("#player_id")[0].textContent=="" ){
						alert('item /player is void!\n物品或玩家不能为空');
						return false;				
					}
                    $.ajax({
                        type : "post",
                        url : "insert_do.php",
                        contentType : "application/x-www-form-urlencoded; charset=utf-8",
                        dataType : "json",
                        data : gettext(),
                        beforeSend : function(XMLHttpRequest) {
                            //alert("提交");
                            $("#wait")[0].textContent = "waitng";
							$("#submit").prop("disabled", true);
							$("#wait2").html("<img src='images/ui-anim_basic_16x16.gif'></img>");
                        },
                        //成功(先成功,后完成)
                        success : function(data, textStatus) {
							if(data.result!=true){
                            	alert("return err:" + data);
								$("#wait")[0].textContent = "Server Err";
							}
							if(data.isempty){
								$("#wait")[0].textContent = "Insert OK";
							}else{
								$("#wait")[0].textContent = "Update OK";
							}
                        },
                        error : function(XMLHttpRequest, textStatus, errorThrown) {
                            $("#wait")[0].textContent = "ERR";
                            alert("ERR:" + XMLHttpRequest.responseText);
                        },
						complete:function(XHR, TS){
							$("#submit").prop("disabled", false);
							$("#wait2").empty();;
						}
                    });
                });
                $('#tbl').dataTable({
                    "bJQueryUI" : true,
					"bInfo":false,
					"bFilter":false,
					"bSort": false,
					"bPaginate": false
                });
                $("#dialog").dialog({
                    // height: 200,
                    modal : true,
                    autoOpen : false,
                });
            });

			// @todo 移除,插入sql 字符串
            function gettext() {
				// 获得各种相的值
                var enable = "1";
				var type = $('input[name=radio]:checked').val()
                var iditem = $("#item_id")[0].textContent.replace(/[^0-9\.]+/g,"");
                var idplayer = $("#player_id")[0].textContent.replace(/[^0-9\.]+/g,"");
				// 支持k/m单位
                var qty = $("#qty")[0].value.replace(/[^0-9\.]+/g,"");
				if($("#qty")[0].value.toLowerCase().indexOf("k") >= 0){
					qty=qty*1000;
				}else if($("#qty")[0].value.toLowerCase().indexOf("m") >= 0){
					qty=qty*1000*1000;
				}
                var c = $("#c")[0].value.replace(/[^0-9\.]+/g,"");
				if($("#c")[0].value.toLowerCase().indexOf("k") >= 0){
					c=c*1000;
				}else if($("#c")[0].value.toLowerCase().indexOf("m") >= 0){
					c=c*1000*1000;
				}
                var hath = $("#hath")[0].value.replace(/[^0-9\.]+/g,"");
				if($("#hath")[0].value.toLowerCase().indexOf("k") >= 0){
					hath=hath*1000;
				}else if($("#hath")[0].value.toLowerCase().indexOf("m") >= 0){
					hath=hath*1000*1000;
				}
                var src = $("#src")[0].value;
				var note= $("#note")[0].value;
				// var d = new Date();
				// var st=d.getTime()/1000;///unix时间戳
            	// var str = "INSERT INTO `wtb`.`wtb` (`enable`,`type`,`iditem`, `idplayer`,`num_want`, `c`, `hath`,`note`,`timestamp`,`src`) VALUES ('";
				// 	str += enable + "', '" + type + "', '"+ iditem + "', '" + idplayer + "','";
				// 	str += qty + "', '" + c + "','" + hath + "','" + note + "','" + st + "','" + src + "');";
            	//  $("#output")[0].textContent = str;
				// 构造数据库字段
				str="";				
				str+="type="+type;
				str+="&iditem="+iditem+"&idplayer="+idplayer;
				str+="&bitem="+"1";
				str+="&qty="+qty+"&c="+c+"&hath="+hath;
				str+="&note="+note+"&src="+src;
                return str;
            }
		</script>
	</head>

	<body>
		<div align="">
			<div id="toolbar" class="ui-widget-header ui-corner-all">
				<button id="home" value="Submit" title="<?php echo _("Return to home");?>">
					<?php echo _("Home");?>
				</button>
				<button id="submit" value="Submit"  title="<?php echo _("submit the order");?>">
					<?php echo _("Submit");?>
				</button>
			</div>
			<span id="wait2"></span>
			<span id="wait"></span>
		</div>
		<p></p>
		<div>
			<table id="tbl" cellpadding="0" cellspacing="0" border="1" class="display" width="100%">
				<thead>
					<th width="15%" title="<?php echo _("type of order");?>"><?php echo _("Type");?></th>
					<th width="14%" title="<?php echo _("Item or Equip");?>"><?php echo _("Item/Equip");?></th>
					<th width="12%" title="<?php echo _("Player name");?>"><?php echo _("Player");?>
					<button id="add_player" class="add">
						<?php echo _("Add Player");?>
					</button></th>
					<th width="10%" title="<?php echo _("Buy/sell quantity (minimum 1, leave blank limitation)");?>"><?php echo _("Qty.");?></th>
					<th width="8%" title="<?php echo _("Leave blank not accept payment by Credit");?>"><?php echo _("Credit");?></th>
					<th width="4%" title="<?php echo _("Leave blank Hath not accepted as a payment method");?>"><?php echo _("Hath");?></th>
					<th width="18%" title="<?php echo _("Note(Optional)");?>"><?php echo _("Note");?></th>
					<th>BBS Link</th>
				</thead>
				<tbody>
					<tr>
						<td  align="middle">
							<div id="radio">
								<input type="checkbox" checked class="chitic enb checked"/>
								<input type="radio" id="wtb" name="radio" checked="checked" value="0"/><label for="wtb"><?php echo _("WTB");?></label>
								<input type="radio" id="wts" name="radio" value="1" /><label for="wts"><?php echo _("WTS");?></label>
								<input type="radio" id="wtt" name="radio" value="2" /><label for="wtt"><?php echo _("WTT");?></label>
							</div>
						</td>
						<td align="middle">
							<label id="item_id"  style="display:none;" ></label>
							<input id="item"  title="支持自动补全" placeholder="<?php echo _("eg.");?> Energy" >
							</input></td>
						<td  align="middle">
							<label id="player_id"  style="display:none;" ></label>
							<input id="player" title="支持自动补全" placeholder="<?php echo _("eg.");?> SomeOne">
						</td>
						<td align="middle" >
							<input  style="width:100%" type="text" class="nb" id="qty" value="1" title="<?php echo _("eg.");?> 31 14c 0.1k 59k 2.6K 5.3m 5M "/>
						</td>
						<td align="middle" >
							<input style="width:100%" type="text" class="nb" id="c" title="<?php echo _("eg.");?> 31 14c 0.1k 59k 2.6K 5.3m 5M " placeholder="<?php echo _("eg.");?> 1.5k"/>
						</td>
						<td align="middle">
						<input style="width:100%" type="text" class="nb" id="hath" title="<?php echo _("eg.");?> 31 14c 0.1k 59k 2.6K 5.3m 5M " placeholder="<?php echo _("eg.");?> 5"/>
						</td>
						<td align="middle">
						<input style="width:100%" type="text" id="note"  title="备注信息" placeholder="(可选)输入一些备注信息"/>
						</td>
						<td align="middle" >
						<input style="width:100%" type="text" id="src" title="BBS连接 例如: http://forums.e-hentai.org/index.php?showtopic=xxxxxx" placeholder="<?php echo _("bbs link");?>"/>
						</td>
					</tr>
				</tbody>
			</table>
			<p align="middle" style="margin: 100px;">
				<code id="output">
					[---]
				</code>
			</p>
		</div>
		<!--  弹出对话框  -->
		<div id="dialog" title="<?php echo _("Add player");?>">
			<div align="middle">
				<label for="name"><?php echo _("Player Name");?></label></br>
				<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all">
				</br>
				<label for="id" title="This link find your ID"><?php echo _("Player ID[?]");?></label></br>
				<input type="text" name="id" id="id" value="" class="text ui-widget-content ui-corner-all">
				</br>
				<button id="btnAdd" class="btn" title="<?php echo _("Add a new player name to player list");?>">
					<?php echo _("Add");?>
				</button>
				<button id="btnCal" class="btn">
					<?php echo _("Cancel");?>
				</button>
			</div>
			<label>1. This Link </label><a href="http://forums.e-hentai.org/index.php">e-hentai.org</a></br>
			<label>2. Check "Logged in as: [YOUR USER NAME]"</label></br>
			<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;at the upper left corner</label></br>
			<label>3. ID is index.php?showuser=XXXXXXXX </label></br>
		</div>
	</body>
</html>
