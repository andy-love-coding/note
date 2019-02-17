// 初始化 tree 结构
function loadTree(tData){
	var ul = $('<ul>');
	for(var i=0; i<tData.length; i++){
		var li = $('<li>').appendTo(ul);		
		var node = $('<a>').attr({
		    "href" : tData[i].url,
		    // "target" : "_blank"
		}).appendTo(li);
		// var icon = $('<i>').css('margin-right','5').appendTo(node);
		var icon = $('<i>').appendTo(node);
		
		var aTree = $('<span>').html(tData[i].title).appendTo(node);
		var input = $('<input>').addClass('field').val(tData[i].field).css({'display':'none'}).appendTo(node);

		// 处理有子节点的
		if(tData[i].children != undefined){
			// 添加图标样式
			icon.addClass('fa fa-minus-square-o');
			var ic = $('<i>').addClass('fa');  //fa-folder-open-o
			icon.after(ic).addClass('status');
			icon.addClass('tree-node');
			
			// 添加标记节点是否打开
			$('<input>').addClass('open').val(tData[i].open).css('display','none').appendTo(node);            

			// 递归遍历子节点
			loadTree(tData[i].children).appendTo(li);
		} else{
			// 叶子节点新增是否可选
			$('<input>').addClass('candidate').val(tData[i].candidate).css('display','none').appendTo(li);
		}
	}
	return ul;
}

// 点击展开或关闭节点
function nodeClick(box){
	box.find('.tree-node').click(function(oEvent){		
		var parent = $(this).parent();

		// 判断该节点是否开启
		if($.trim(parent.find('.open').val()) == 'true'){
			// 已开启，则关闭节点
			parent.next().slideUp(500);
			parent.find('.open').val('false');
			parent.find('.status').removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
			return false;
		} else{
			// 开启前关闭节点下的所有节点
			// parent.next().find('.tree-node').parent().each(function(){
			// 	$(this).next().css('display','none');
			// 	$(this).find('.open').val('false');
			// 	$(this).find('.status').removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
			// })

			// 已关闭，则开启节点
			parent.find('.open').val('true');
			parent.find('.status').removeClass('fa-plus-square-o').addClass('fa-minus-square-o');			
			parent.next().slideDown(500);
			return false;
		}
	})
}

// 选中时的样式
$('#tree').on('click',function(event){
	$('#tree').find('a').removeClass('now');
	$(event.target.parentNode).addClass('now');
});

