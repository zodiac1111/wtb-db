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
						$("#item").removeClass("ui-autocomplete-loading");
						return true;
					},
					focus: function (event, ui) {
						$("#item_id")[0].textContent=ui.item.id;
						$("#item").removeClass("ui-autocomplete-loading");
						return true;
                    },
					open: function() {
						$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
					},
					close: function() {
						$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
					}
				});
				// 装备连接检查.初步通过则交给后端查询
				$( "#equip" ).change(function(){
					$("#equip").addClass("ui-autocomplete-loading");
					$("#equip_name").val("<?php echo _("Check link...");?>");
					//$(this).css("background-color","#FFFFCC");
					var match=$(this).val()
						.match(/^(((http:\/\/)*hentaiverse.org\/pages\/showequip.php)*\?)*eid=[0-9]{1,16}\&key=[0-9a-zA-Z]{1,16}/);
					if(match==null){
						$("#equip_name").val("<?php echo _("Invalid link");?>");
						$("#equip").removeClass("ui-autocomplete-loading");
						return false
					}
					// 找到了合法有效的链接.
					var token=$(this).val().match(/eid=([0-9]{1,16})\&key=([0-9a-zA-Z]{1,16})/);
					var eid=token[1];
					var key=token[2];
					var equip_name="";
					// 给后端
					$.ajax({
		                type : "post",
		                url : "qequip.php",
		                contentType : "application/x-www-form-urlencoded; charset=utf-8",
		                dataType : "json",
		                data : "eid="+ eid+"&key="+key+"&equid_name",
		                beforeSend : function(XMLHttpRequest) {
		                    //alert("提交");
		                   $("#equip_name").val("<?php echo _("Searching in Database...");?>");
		                },
		                //成功(先成功,后完成)
		                success : function(data, textStatus) {
							//alert(data);
							if(data.equip_name!=""){
								$("#equip_name").val(data.equip_name);
								$("#equip_id")[0].textContent=eid;
							}else{
								$("#equip_id")[0].textContent="";
								$("#equip_name").val("");
								$("#equip_name").attr("placeholder","<?php echo _("Plz Input EquipName manual");?>");
								
							}
							return true;
		                },
		                error : function(XMLHttpRequest, textStatus, errorThrown) {
		                    alert("ERR:" + XMLHttpRequest.responseText+errorThrown);
		                    $("#player_id")[0].textContent="";
		                    return false;
		                },
						complete:function(XHR, TS){
							$("#equip").removeClass("ui-autocomplete-loading");
						}
		            });	
				});
				 // 使能装备名称改变时提交插入数据库
			$( "#equip_name" ).change(function(){
				if($("#equip_name").val()==""){
					return false;
				}
				$("#equip_name").addClass("ui-autocomplete-loading");
				var match=$("#equip").val()
					.match(/^(((http:\/\/)*hentaiverse.org\/pages\/showequip.php)*\?)*eid=[0-9]{1,16}\&key=[0-9a-zA-Z]{1,16}/);
				if(match==null){
					$("#equip").val("<?php echo _("Invalid link");?>");
					$("#equip_name").removeClass("ui-autocomplete-loading");
					return false;
				}
				// 找到了合法有效的链接.
				var token=$("#equip").val().match(/eid=([0-9]{1,16})\&key=([0-9a-zA-Z]{1,16})/);
				var eid=token[1];
				var key=token[2];
				var equip_name=$("#equip_name").val();
				$.ajax({
					type : "post",
					url : "aequip.php",
					contentType : "application/x-www-form-urlencoded; charset=utf-8",
					dataType : "json",
					data : "eid="+eid+"&key="+key+"&equip_name="+equip_name,
					beforeSend : function(XMLHttpRequest) {
						//alert("提交");
						$("#equip_name").addClass("ui-autocomplete-loading");
					},
					//成功(先成功,后完成)
					success : function(data, textStatus) {
						$("#equip_name").removeClass("ui-autocomplete-loading");
						$("#equip_id")[0].textContent=eid;
					},
					error : function(XMLHttpRequest, textStatus, errorThrown) {
						$("#equip_name").removeClass("ui-autocomplete-loading");
						$("#equip_id")[0].textContent="";
						alert("ERR:" + XMLHttpRequest.responseText);
					},
					complete:function(XHR, TS){
						$("#equip_name").removeClass("ui-autocomplete-loading");
					}
				});
			});
				// 自动完成  玩家名称
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
						$("#player").removeClass("ui-autocomplete-loading");
						return true;
					},
					focus: function (event, ui) {
						$("#player_id")[0].textContent=ui.item.id;
						$("#player").removeClass("ui-autocomplete-loading");
						return true;
                    },
					open: function() {
						$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
					},
					close: function() {
						$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
					}
				});
				$("#t_item").button({
					//
					}).click(function() {
						$('#tbl').dataTable().fnSetColumnVis( 2,false ); //装备列隐藏
						$('#tbl').dataTable().fnSetColumnVis( 3,false ); //装备名称列隐藏
						$('#tbl').dataTable().fnSetColumnVis( 1,true ); //物品列显示
						$('#tbl').dataTable().fnSetColumnVis( 5,true ); //数量列显示
                });
                $("#t_equip").button({
					//
					}).click(function() {
						$('#tbl').dataTable().fnSetColumnVis( 1,false ); // 物品列隐藏
						$('#tbl').dataTable().fnSetColumnVis( 5,false ); //数量列隐藏
						$('#tbl').dataTable().fnSetColumnVis( 2,true ); //装备列显示
						$('#tbl').dataTable().fnSetColumnVis( 3,true ); //装备名称列显示
						$("#wts").click(); //一般物品都是来卖的.自动点击一下
                });
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
						alert('<?php echo _("Name or PlayID is void!");?>');
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
		                    $("#wait")[0].textContent = "<?php echo _("Pending");?>";
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
                // 帮助手册(TODO = =)
                $("#help").button({
                    icons : {
                        primary : "ui-icon-help"
                    }
                }).click(function() {
                    alert("还没写  = =");
                });
                // 导出数据库
                $("#export").button({
                    icons : {
                        primary : "ui-icon-extlink"
                    }
                }).click(function() {
					$.ajax({
						async: false,
                        type : "get",
                        url : "export.php",
                        contentType : "application/x-www-form-urlencoded; charset=utf-8",
                        dataType : "json",
                        data : "",
                        beforeSend : function(XMLHttpRequest) {
                            //alert("提交");
                            $("#wait2").html("<img src='images/ui-anim_basic_16x16.gif'></img>");
                            $("#wait")[0].textContent = "<?php echo _("Pending");?>";
							$("#export").prop("disabled", true);
                        },
                        //成功(先成功,后完成)
                        success : function(data, textStatus) {
							//alert("return :" + data);
							$("#wait")[0].textContent = "<?php echo _("OK");?>";
							if(data.ret=="0"){
								top.location.href = "/db.gz";
							}else{
								alert("return :" + data);
							}
                        },
                        error : function(XMLHttpRequest, textStatus, errorThrown) {
                            $("#wait")[0].textContent = "ERR";
                            alert("ERR:" + XMLHttpRequest.responseText);
                        },
						complete:function(XHR, TS){
							$("#export").prop("disabled", false);
							$("#wait2").empty();;
						}
                    });
                    
                });
				// 添加交易条目
                $("#submit").button({
                    icons : {
                        primary : "ui-icon-check"
                    }
                }).click(function() {
                    // 点击事件
					if($("#player_id")[0].textContent=="" ){
						alert('<?php echo _("Player name is void!");?>');
						return false;				
					}
					var obj = $('input[name=radio_itemtype]:checked').val(); 
					if(obj=="0" && $("#item_id")[0].textContent==""){
						alert('<?php echo _("Item is void!");?>');
						return false;		
					}
					if(obj=="1" && $("#equip_id")[0].textContent==""){
						alert('<?php echo _("Equipment is void!");?>');
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
                            $("#wait2").html("<img src='images/ui-anim_basic_16x16.gif'></img>");
                            $("#wait")[0].textContent = "<?php echo _("Pending");?>";
							$("#submit").prop("disabled", true);
                        },
                        //成功(先成功,后完成)
                        success : function(data, textStatus) {
							if(data.result!=true){
                            	alert("return err:" + data);
								$("#wait")[0].textContent = "<?php echo _("Server Err");?>";
							}
							if(data.isempty){
								$("#wait")[0].textContent = "<?php echo _("Insert OK");?>";
							}else{
								$("#wait")[0].textContent = "<?php echo _("Update OK");?>";
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
                // 按钮集合
                $( "#radio" ).buttonset();
				$( "#radio_itemtype" ).buttonset();
				$("#wtb").click(); //自动选择指定按钮(默认值)
				$("#t_item").click();
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
				var type = $('input[name=radio]:checked').val();
				var obj = $('input[name=radio_itemtype]:checked').val(); //类型:物品还是装备 物品0,装备1,其他待定
				var idplayer = $("#player_id")[0].textContent.replace(/[^0-9\.]+/g,"");
				var idequip=0
				var equip_key=0
				var iditem=0
				var qty=1
				// 按照东西类型分类
				if(obj=="0"){ //只有是道具的时候数量才有意义,装备就让数量固定
					iditem = $("#item_id")[0].textContent.replace(/[^0-9\.]+/g,"");
					qty = $("#qty")[0].value.replace(/[^0-9\.]+/g,"");
					if($("#qty")[0].value.toLowerCase().indexOf("k") >= 0){
						qty=qty*1000;
					}else if($("#qty")[0].value.toLowerCase().indexOf("m") >= 0){
						qty=qty*1000*1000;
					}
				}else{
					idequip = $("#equip_id")[0].textContent.replace(/[^0-9\.]+/g,"");
					equip_key = $("#equip_key")[0].textContent.replace(/[^0-9a-zA-Z\.]+/g,"");
				}
				
				// 支持k/m单位
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
				str+="&idplayer="+idplayer;
				str+="&obj="+obj;		
				str+="&idequip="+idequip;
				str+="&iditem="+iditem;
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
				<span id="radio_itemtype">
					<input type="radio" name="radio_itemtype" id="t_item"  value="0" /><label for="t_item"><?php echo _("Item");?></label>
					<input type="radio" name="radio_itemtype" id="t_equip" value="1" /><label for="t_equip"><?php echo _("Equip");?></label>
				</span>
				<button id="add_player" class="add">
					<?php echo _("Add Player");?>
				</button>
				<button id="submit" value="Submit"  title="<?php echo _("submit the order");?>">
					<?php echo _("Submit");?>
				</button>
				<button id="help" value="Help"  title="<?php echo _("How to add a new order");?>">
					<?php echo _("Help");?>
				</button>
				<button id="export" value="Export"  title="<?php echo _("Export the database");?>">
					<?php echo _("Export");?>
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
					<!-- V装备和物品列同时只显示两者之一 -->
					<th width="14%" title="<?php echo _("Item");?>"><?php echo _("Item");?></th>
					<th width="18%" title="<?php echo _("Equip link");?>"><?php echo _("Equip");?></th>
					<th width="25%" title="<?php echo _("Equip Name");?>"><?php echo _("Equip Name");?></th>
					<!-- ^装备和物品列同时只显示两者之一 -->
					
					<th width="10%" title="<?php echo _("Player name");?>"><?php echo _("Player");?></th>
					<th width="10%" title="<?php echo _("Buy/sell quantity (minimum 1, leave blank limitation)");?>"><?php echo _("Qty.");?></th>
					<th width="8%" title="<?php echo _("Leave blank not accept payment by Credit");?>"><?php echo _("Credit");?></th>
					<th width="7%" title="<?php echo _("Leave blank Hath not accepted as a payment method");?>"><?php echo _("Hath");?></th>
					<th width="10%" title="<?php echo _("Note(Optional)");?>"><?php echo _("Note");?></th>
					<th>BBS Link</th>
				</thead>
				<tbody>
					<tr>
						<td  align="middle">
							<div id="radio" style="width:100%" >
								<input type="radio" id="wtb" name="radio" value="0" /><label for="wtb"><?php echo _("WTB");?></label>
								<input type="radio" id="wts" name="radio" value="1" /><label for="wts"><?php echo _("WTS");?></label>
								<input type="radio" id="wtt" name="radio" value="2" /><label for="wtt"><?php echo _("WTT");?></label>
							</div>
						</td>
						<td align="middle">
							<label id="item_id" style="display:none;" ></label>
							<input style="width:100%" id="item" title="支持自动补全" placeholder="<?php echo _("eg.");?> Energy" >
							</input></td>
						<td align="middle">
							<label id="equip_id" style="display:none;" ></label>
							<label id="equip_key" style="display:none;" ></label>
							<input style="width:100%" id="equip" title="<?php echo _("eq. ");?>http://hentaiverse.org/pages/showequip.php?eid=43120719&key=4d3a81dca0" placeholder="<?php echo _("equip link");?>"/>
						</td>
						<td align="middle">
							<input style="width:100%" id="equip_name" title="<?php echo _("eq. ");?>Average Axe of the Vampire" value="<?php echo _("[Equip Name]");?>"/>
						</td>
						<td  align="middle">
							<label id="player_id" style="display:none;" ></label>
							<input style="width:100%" id="player" title="支持自动补全" placeholder="<?php echo _("eg.");?> SomeOne">
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
						<input style="width:100%" type="text" id="note"  title="<?php echo _("eg. Only players level 250 or less");?>" placeholder="<?php echo _("Note");?>"/>
						</td>
						<td align="middle" >
						<input style="width:100%" type="text" id="src" title="<?php echo _("BBS link eg.");?> http://forums.e-hentai.org/index.php?showtopic=xxxxxx" placeholder="<?php echo _("bbs link");?>"/>
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
