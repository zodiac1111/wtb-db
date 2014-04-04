<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include_once 'languages.php'; ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo _("HV Trade Center");?></title>
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
		<script type='text/javascript' src="js/jquery-2.1.0.min.js"></script>
		<script type='text/javascript' src="js/i18next-1.7.2.min.js"></script>
		<script type='text/javascript' src="js/jquery.dataTables.min.js"></script>
		<script type='text/javascript' src="js/jquery.dataTables.columnFilter.js" ></script>
		<script type='text/javascript' src="js/ui/jquery.ui.core.js"></script>
		<script type='text/javascript' src="js/ui/jquery.ui.widget.js"></script>
		<script type='text/javascript' src="js/ui/jquery.ui.button.js"></script>
		<script type='text/javascript' src="js/ui/jquery.ui.widget.js"></script>
		<script type='text/javascript' src="js/ui/jquery.ui.position.js"></script>
		<script type='text/javascript' src="js/ui/jquery.ui.tooltip.js"></script>
		<script type='text/javascript' src="js/ui/jquery.ui.menu.js"></script>
		<style>
			#toolbar {
				padding: 4px;
				display: inline-block;
			}
			/* support: IE7 */
			*+ html #toolbar {
				display: inline;
			}
			.ui-menu { position: absolute; width: 55px; z-index:999 }
			#lang.ui-menu { position: absolute; width: 60px; z-index:999 }
			.tag {
				border : 1px solid #a5d24a;
				padding : 5px;
				font-family: monospace;
				/*background : #cde69c;*/
			}
			.tag.tgwtb{
				background : #cde69c;
			}
			.tag.tgwts{
				background : #9CCBE6;
			}
			.tag.tgwtt{
				background : #FFF8AB;
			}
			.alignMiddle { text-align: middle; }
			.load {
				background-image: url("images/Flip_Flop.gif");
				background-repeat: no-repeat;
				background-attachment:fixed;
				background-position:center;
				//background-repeat: repeat-y;
			}
			.loadbar {
				background-image: url("images/loadbar.gif");
				background-position: center,center;
				background-repeat: no-repeat;
				background-attachment: scroll;
			}
		</style>
		<script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
                /// jQuery UI
                $("#reload").button({
                    icons : {
                        primary : "ui-icon-refresh"
                    }
                }).click(function() {
                    $("#tbl").dataTable().fnDraw(false);
                });
				/// 首页
                $("#home").button({
                    icons : {
                        primary : "ui-icon-home"
                    }
                }).click(function() {
                    top.location.href = "/index.html";
                });
				/// 新增交易
                $("#add").button({
                    icons : {
                        primary : "ui-icon-circle-plus"
                    }
                }).click(function() {
                    top.location.href = "/insert.php";
                });
				// 拍卖:未实现
                $("#auction").button({
					 icons : {
                        primary : "ui-icon-person"
                    }
                }).click(function() {
					;
                });
				// 语言选项 l18n未实现,次级优先级
				$(".btnl18n").button({
					icons: {
						primary: "ui-icon-flag"
					}
				}).next()
					.button({
						text: false,
						icons: {
							primary: "ui-icon-triangle-1-s"
						}
					}).click(function() {
						var menu = $( this ).parent().next();
						// 鼠标离开菜单,菜单隐藏
						menu.mouseleave(function(){
					  		$(this).hide();
							return false;
						})
						// 点击按钮,菜单循环隐藏和显示
						if(menu[0].style.display=="none"){
							menu.show();
						}else{
							menu.hide();
						}
						// 点击其他元素,菜单隐藏
						$(document).one( "click", function() {
							menu.hide();
						});
						// 菜单点击
						menu.click(function(){
							// 选择不同语言,这里通过连接传递 ?lang=zh_CN 这样的变量实现
							// alert("<?php echo _("Unimplemented");?>"+this);
							// 有些语言实现了,有些没有实现
						});
						return false;
					})
					.mouseleave(function(){ ///离开下拉箭头按钮
					  	//$(this).parent().next().hide();
						return false;
					})
					.parent()
						.buttonset()
						.next()
							.hide()
							.menu();

                $("#Rev").button();
				// 类别选项,wtb/wts/wtt
				$("#type" ).buttonset().click(function(){
					$("#tbl").dataTable().fnDraw(false); ///刷新表格
				});
                // **** 主要:一整个表格 ****
                $('#tbl').dataTable({
					"sPaginationType": "full_numbers", //直接显示页码
                    "bJQueryUI" : true,
                    "bProcessing" : true,
                    "bServerSide" : true,
					"sScrollY": 350,
					"iDisplayLength": 25, //默认显示的条目数量
					"oLanguage": {"sUrl": "dataTables.<?php echo _("en_US");?>.txt"}, // datatable的翻译语言选项
                    // 数据源
                    "sAjaxSource" : "q1.php",
                    // 传递参数进入php
                    "fnServerParams" : function(aoData) {
						// 选择的交易类型 
                        aoData.push({
                            "name" : "wtb",
                            "value" : $("#enb_wtb")[0].checked?"1":"0"
                        },{
                            "name" : "wts",
                            "value" : $("#enb_wts")[0].checked?"1":"0"
						},{
                            "name" : "wtt",
                            "value" : $("#enb_wtt")[0].checked?"1":"0"
						});
                    },
                    "fnDrawCallback" : function(oSettings) {
						//$(".tag").
						$("#menu").menu();
                        $( ".btnManage" )
							.button({
									text: false,
									icons: {
										primary: "ui-icon-trash"
									}
							})
							.click(function() {
								delete_order(this.parentElement.parentElement.parentElement
								,this.parentElement.parentElement.parentElement.firstChild.lastChild.textContent);
							})
							.next()
								.button({
									text: false,
									icons: {
										primary: "ui-icon-triangle-1-s"
									}
								})
								.click(function() {
									var menu = $( this ).parent().next();
									// 鼠标离开菜单,菜单隐藏
									menu.mouseleave(function(){
								  		$(this).hide();
										return false;
									})
									// 点击按钮,菜单循环隐藏和显示
									if(menu[0].style.display=="none"){
										menu.show();
									}else{
										menu.hide();
									}
									// 点击其他元素,菜单隐藏
									$(document).one( "click", function() {
										menu.hide();
									});
									// 菜单项点击
									menu.click(function(){
										alert("<?php echo _("Unimplemented");?>"+this);
									});
									return false;
								})
								.mouseleave(function(){
								  	//$(this).parent().next().hide();
									return false;
								})
								.parent()
									.buttonset()
									.next()
										.hide()
										.menu();
                    },
					"aaSorting": [[ 0, "desc" ]], //默认按第一列降序排列
/*
					"fnServerData": function( sUrl, aoData, fnCallback ) {
						$.ajax( {
						    "url": sUrl,
						    "data": aoData,
						    "success": fnCallback,
						    "dataType": "jsonp",
						    "cache": false
						} );
					}, */
                    // 列定义
                    "aoColumnDefs" : [{
                        "mData" : "idwtb",
                        "aTargets" : [0],
                        "mRender" : function(data, type, full) {
                            // 'full' is the row's data object, and 'data' is this column's data
                            // e.g. 'full[0]' is the comic id, and 'data' is the comic title
                            return  data;
                        }
                    }, {
                        "mData" : "type",
                        "aTargets" : [1],
						"bSortable": false,
                        "mRender" : function(data, type, full) {
                            // 'full' is the row's data object, and 'data' is this column's data
                            // e.g. 'full[0]' is the comic id, and 'data' is the comic title
							if(data=="0"){
								return '<span class="tag tgwtb"><?php echo _("wtb");?></span>';
							}else if(data=="1"){
								return '<span class="tag tgwts"><?php echo _("wts");?></span>';
							}else if(data=="2"){
								return '<span class="tag tgwtt"><?php echo _("wtt");?></span>';
							}else{
								return "E:"+data;
							}
                        }
                    },{
                        "mData" : "item_name",
                        "aTargets" : [2],
						"bSearchable": true
                    }, {
                        "mData" : "play_name",
                        "aTargets" : [3],
						"mRender" : function(data, type, full) {
                            return '<a href="http://forums.e-hentai.org/index.php?showuser=' + full.idplay + '">'+data+'</a>';
                        }
                    }, {
                        "mData" : "c",
                        "aTargets" : [4],
                        "mRender" : function(data, type, full) {
							if(data=="0" || data=="" || data==null ){
								return "-"
							}
                            return parseFloat(data).toLocaleString();
                        }
                    }, {
                        "mData" : "hath",
                        "aTargets" : [5],
                        "mRender" : function(data, type, full) {
							if(data=="0" || data=="" || data==null ){
								return "-"
							}
                            return parseFloat(data).toLocaleString();
                        }
                    }, {
                        "mData" : "num_want",
						"bSortable": false,
                        "aTargets" : [6],
                        "mRender" : function(data, type, full) {
							if(data=="0" || data=="" || data==null ){
								return "<?php echo _("Unlimited");?>"
							}
							 return parseInt(data).toLocaleString();
                        }
                    }, {
						///	 bbs连接
                        "mData" : "src",
						"bSortable": false,
                        "aTargets" : [7],
                        "mRender" : function(data, type, full) {
                            // 'full' is the row's data object, and 'data' is this column's data
                            // e.g. 'full[0]' is the comic id, and 'data' is the comic title
                            return '<a href="' + data + '"><?php echo _("link");?></a>';
                        }
                    }, {
						/// 更新时间
                        "mData" : "timestamp",
						"bSortable": false,
                        "aTargets" : [8],
                        "mRender" : function(data, type, full) {
							// unix时间戳转化成为毫秒
							d=new Date(data*1000);
                            return d.toLocaleString() ;
                        }
                    }, {
						/// 备注
                        "mData" : "note",
						"bSortable": false,
                        "aTargets" : [9],
                        "mRender" : function(data, type, full) {
                            return data ;
                        }
                    }, {
						/// 管理按钮
						"mData" : "note",
						"bSortable": false,
                        "aTargets" : [10],
                        "mRender" : function(data, type, full) {
                            return '<span>'
								+'	<button class="btnManage"><?php echo _("Delete");?></button>'
								+'	<button class="select"><?php echo _("Set");?></button>'
								+'</span>'
								+'<ul id="menu">'
								+'	<li><a href="#"><span class="ui-icon ui-icon-pencil"></span><?php echo _("Edit");?></a></li>'
								+'</ul>';
                        }
                    }]
                }).columnFilter({
					"iFilteringDelay":500,
					"aoColumns": [ 
							null,
							null,
							 { type: "text" },
							 { type: "text" },null,null,null,null,null,null,null
				]

		});

            });
			// 删除订单,tr 删除的行 , id 订单号
            function delete_order(tr,id) {
                $.ajax({
                    type : "post",
                    url : "delete.php",
                    contentType : "application/x-www-form-urlencoded; charset=utf-8",
                    dataType : "text",
                    data : "wtbid="+id,
                    beforeSend : function(XMLHttpRequest) {
                        // $("#wait")[0].textContent = "waitng";
						$(tr).addClass("loadbar");
						//$(tr).prop("disabled", true);
                    },
                    //成功(先成功,后完成)
                    success : function(data, textStatus) {
						// alert("reset: "+data);
						if(data!="1"){
							alert("reset err: "+data);
						}
						$(tr).hide("slow"); // 移除行
						$("#tbl").dataTable().fnDraw(false); ///刷新表格
                    },
                    error : function(XMLHttpRequest, textStatus, errorThrown) {
                        alert("ERR:" + XMLHttpRequest.responseText);
                    }
                });
            }
		</script>
	</head>
	<body>
		<h1><?php echo _("helloworld"); echo "locale=".$locale;?></h1>
		<div>
			<div align="">
				<div id="toolbar" class="ui-widget-header ui-corner-all">
					<button id="home" value="Submit"><?php echo _("Home");?></button>
					<button id="add" title="<?php echo _("New order");?>"><?php echo _("Add");?></button>
					<button id="auction" value="auction" title="<?php echo _("Unimplemented");?>"><?php echo _("Auction");?></button>
					<input type="checkbox" id="Rev" title="<?php echo _("rev");?>"><label for="Rev"><?php echo _("Rev.");?></label>
					<span id="type">
						<input type="checkbox" id="enb_wtb" checked><label for="enb_wtb" title="<?php echo _("want to buy");?>"><?php echo _("WTB");?></label>
						<input type="checkbox" id="enb_wts" checked><label for="enb_wts" title="<?php echo _("want to sell");?>"><?php echo _("WTS");?></label>
						<input type="checkbox" id="enb_wtt" "><label for="enb_wtt" title="<?php echo _("Unimplemented");?>"><?php echo _("WTT");?></label>
					</span>
					<button id="reload" value="reload" title="<?php echo _("reload the order");?>"><?php echo _("Reload");?></button>
					<span>					
						<span>
							<button class="btnl18n" title="<?php echo _("Unimplemented");?>"><?php echo _("English");?></button>
							<button class="set" title="<?php echo _("Unimplemented");?>"><?php echo _("Set");?></button>
						</span>
						<ul id="lang">
								<li id="lang_en_US"><a href="?lang=en_US">English</a></li>
								<li id="lang_ja_JP"><a href="?lang=ja_JP">日本語</a></li>
								<li id="lang_zh_CN"><a href="?lang=zh_CN">中文</a></li>
								<li id="lang_zh_TW"><a href="?lang=zh_TW">漢語</a></li>
						</ul>
					</span>
				</div>
				<span id="wait"></span>
			</div>
			<p></p>
			<div>
				<table id="tbl" cellpadding="0" cellspacing="0" border="1" class="display" width="100%">
					<thead>
						<tr>
							<th width="6%"  title="<?php echo _("id");?>"><?php echo _("ID");?></th>
							<th width="6%"  title="<?php echo _("type");?>"><?php echo _("Type");?></th>
							<th width="13%" title="<?php echo _("item or equipment");?>"><?php echo _("Item/Equip");?></th>
							<th width="11%" title="<?php echo _("palyer name");?>"><?php echo _("Player");?></th>
							<th width="8%" title="<?php echo _("- means not accepted");?>"><?php echo _("Credit");?></th>
							<th width="7%" title="<?php echo _("- means not accepted");?>"><?php echo _("Hath");?></th>
							<th width="6%" title="<?php echo _("Quantity of items");?>"><?php echo _("Qty.");?></th>
							<th width="5%" title="bbs 连接"><?php echo _("Ref.");?></th>
							<th width="14%" title="交易加入时间"><?php echo _("Time");?></th>
							<th title="<?php echo _("Note");?>"><?php echo _("Note");?></th>
							<th width="70px" title="<?php echo _("Manage Operation");?>"><?php echo _("Manage");?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan="10" class="dataTables_empty" align="middle"><?php echo _("Loading data from server...");?></td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<!-- 页脚不指定宽度反而能对齐了 -->
							<th><?php echo _("ID");?></th>
							<th><?php echo _("Type");?></th>
							<th><?php echo _("Item/Equip");?></th>
							<th><?php echo _("Player");?></th>
							<th><?php echo _("Credit");?></th>
							<th><?php echo _("Hath");?></th>
							<th><?php echo _("Qty.");?></th>
							<th><?php echo _("Ref.");?></th>
							<th><?php echo _("Time");?></th>
							<th><?php echo _("Note");?></th>
							<th><?php echo _("Manage");?></th>
						</tr>
					</tfoot>
				</table>
				<p></p>
				<div align="right">
					<label><?php echo _("HV Trade Center");?> v0.1.9 </br></label>
					<label>source code:<a href='https://github.com/zodiac1111/wtb-db'>https://github.com/zodiac1111/wtb-db</a></label>
				</div>
			</div>
		</div>
	</body>
</html>
