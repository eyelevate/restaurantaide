$(document).ready(function(){
	$("#groupsUl").treeview();
		
	//add page scripts
	$("#accessDisplay").change(function(){
		var checked = $(this).attr('checked');
		if(checked == 'checked'){
			$("#acoDiv").show();
		} else {
			$("#acoDiv").hide();
		}
	});
	$(".accessRadio").click(function(){
		var status = $(this).val();
		groups.access(status);
	});
	$("#groupsUl input[type='checkbox']").click(function(){
		var controller = $(this).attr('id');
		var type = $(this).attr('class');
		var checked = $(this).attr('checked');
		groups.checked(controller,type,checked);

	});
});

groups = {

	access: function(status){
		switch(status){
			case 'Yes':
				$(".controller").click();
				$(".action").attr('checked');
				$("#Access").removeAttr('checked');
				$(".action[controller='Access']").removeAttr('checked');
				$("#Groups").removeAttr('checked');
				$(".action[controller='Groups']").removeAttr('checked');
				$(".action").attr('disabled','disabled');
				$(".action").attr('checked','checked');

				$("#Access").removeAttr('checked');
				$(".action[controller='Access']").removeAttr('checked');
				$("#Groups").removeAttr('checked');
				$(".action[controller='Groups']").removeAttr('checked');
			break;
			
			case 'No':
				$("#groupsUl input[type='checkbox']").removeAttr('checked');
				$(".action").removeAttr('disabled');
				$("#Hotels").removeAttr('checked');
					$("#Hotels-index").attr('checked','checked');
					$("#Hotels-hotel_pages").attr('checked','checked');
					$("#Hotels-admin").attr('checked','checked');
					$("#Hotels-view").attr('checked','checked');
					$("#Hotels-preview").attr('checked','checked');
				$("#Admins").removeAttr('checked');
					$("#Admins-login").attr('checked','checked');
					$("#Admins-logout").attr('checked','checked');
					$("#Admins-index").attr('checked','checked');
				$("#Attractions").removeAttr('checked');
					$("#Attractions-index").attr('checked','checked');
					$("#Attractions-attraction_pages").attr('checked','checked');
					$("#Attractions-admin").attr('checked','checked');
					$("#Attractions-view").attr('checked','checked');
					$("#Attractions-preview").attr('checked','checked');
				$("#ExchangeRates").removeAttr('checked');
					$("#ExchangeRates-index").attr('checked','checked');
					$("#ExchangeRates-view").attr('checked','checked');
				$("#Ferries").removeAttr('checked');
					$("#Ferries-index").attr('checked','checked');
					$("#Ferries-view").attr('checked','checked');
				$("#Hotels").removeAttr('checked');
					$("#Hotels-index").attr('checked','checked');
					$("#Hotels-hotel_pages").attr('checked','checked');
					$("#Hotels-admin").attr('checked','checked');
					$("#Hotels-view").attr('checked','checked');
					$("#Hotels-preview").attr('checked','checked');
				$("#Inventories").removeAttr('checked');
					$("#Inventories-index").attr('checked','checked');
					$("#Inventories-view").attr('checked','checked');
				$("#InventoryItems").removeAttr('checked');
					$("#InventoryItems-index").attr('checked','checked');
					$("#InventoryItems-view").attr('checked','checked');
				$("#Pages").removeAttr('checked');
					$("#Pages-index").attr('checked','checked');
					$("#Pages-url").attr('checked','checked');
					$("#Pages-logout").attr('checked','checked');
					$("#Pages-view").attr('checked','checked');
					$("#Pages-preview").attr('checked','checked');
				$("#Schedules").removeAttr('checked');
					$("#Schedules-index").attr('checked','checked');
					$("#Schedules-view").attr('checked','checked');
					$("#Schedules-preview").attr('checked','checked');
				$("#Taxes").removeAttr('checked');
					$("#Taxes-index").attr('checked','checked');
					$("#Taxes-view").attr('checked','checked');
			break;
		}		
	},
	checked: function(controller, type, checked){
		if(type =='controller'){			
			if(checked == 'checked'){
				$("#groupsUl input[type='checkbox'][controller='"+controller+"']").attr('checked','true');
				$("#groupsUl input[type='checkbox'][controller='"+controller+"']").attr('disabled','disabled');
			} else {

				$("#groupsUl input[type='checkbox'][controller='"+controller+"']").removeAttr('checked');
				$("#groupsUl input[type='checkbox'][controller='"+controller+"']").removeAttr('disabled');							
			}
		}
	}
}
