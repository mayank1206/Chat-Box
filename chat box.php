<?php
    $email = $this->session->userdata('email');
    $usertype=$this->session->userdata('usertype');
?>
<style type="text/css">
        .mytext{
        border:0;padding:10px;background:whitesmoke;
        }
        .text{
            width:100%;display:flex;flex-direction:column;
        }
        .text > p:first-of-type{
            width:100%;margin-top:0;margin-bottom:auto;line-height: 13px;font-size: 12px;
            color:white;
        }
        .text > p:last-of-type{
            width:100%;color:silver;margin-top:auto;color:white;
            line-height: 1.6;
        }
        .text-l{
            float:left;padding-right:10px; padding-left:10px;
        }        
        .text-r{
            float:right;padding-left:10px; padding-right:10px;
        }
        .macro{
            margin-top:5px;width:60%;border-radius:5px;padding:5px;display:flex;
        }
        .msj-rta{
            float:right;background:white;
        }
        .msj{
            float:left;background:#94C2ED;
        }
        .frame{
            background:white;
            height:450px;
            overflow:hidden;
            padding:0;
        }
        .frame > div:last-of-type{
            position:absolute;bottom:0;width:100%;display:flex;
        }
        body > div > div > div:nth-child(2) > span{
            background: whitesmoke;padding: 10px;font-size: 21px;border-radius: 50%;
        }
        body > div > div > div.msj-rta.macro{
            margin:auto;margin-left:1%;
        }
        .chatlist {
            width:100%;
            list-style-type: none;
            padding:18px;
            position:absolute;
            bottom:2px;
            display:flex;
            flex-direction: column;
            top:0;
            overflow-y:scroll;
            
        }
        .msj:before{
            width: 0;
            height: 0;
            content:"";
            top:-5px;
            left:-14px;
            position:relative;
            border-style: solid;
            border-width: 0 13px 13px 0;
            border-color: transparent #94C2ED transparent transparent;            
        }
        .msj-rta:after{
            width: 0;
            height: 0;
            content:"";
            top:-5px;
            left:14px;
            position:relative;
            border-style: solid;
            border-width: 13px 13px 0 0;
            border-color: white transparent transparent transparent;           
        }  
        input:focus{
            outline: none;
        }        
        ::-webkit-input-placeholder { /* Chrome/Opera/Safari */
            color: #d4d4d4;
        }
        ::-moz-placeholder { /* Firefox 19+ */
            color: #d4d4d4;
        }
        :-ms-input-placeholder { /* IE 10+ */
            color: #d4d4d4;
        }
        :-moz-placeholder { /* Firefox 18- */
            color: #d4d4d4;
        }
        .message-data-name{
        	color: #000000
        }  
    </style>
    <script> 
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
          "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
        ];
        var preid="";
        var predate="";
        var l=0;
        var complex = <?php echo json_encode($conversations); ?>;
        var j=complex.length;
        console.log(complex);
        for(i=j-1;i>=0;i--){
        insertChat(complex[i]["usertypeID"],complex[i]["sender"],complex[i]["msg"],chtim(complex[i]["create_date"]),complex[i]["attach"],complex[i]["attach_file_name"]);}
    function chtim(timepass){
    var date = new Date(timepass);
    
    var year = date.getFullYear();
    var month = monthNames[date.getMonth()];

    var day = date.getDate();
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var seconds = date.getSeconds();
    var ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    return(month + " " + day + "," + hours + ":" + minutes+" "+ampm);
    }

        //console.log(complex);
        function insertChat(id,who, text, time,attach,aname){
            var link="";
            var date=time;
            var control = "";
            var name="";
            var d="";
            l=l+1;
            k="";
            console.log(l);
            if(attach!=null){
                str=aname
                var ext = str.substring(str.lastIndexOf(".") + 1, str.length);
                //ext=str.split(".")[1];
                //alert(ext);
                link='<a href = "<?=base_url('uploads/attach/')?>'+aname+'" data-ext= "'+ext+'" data-source= "conversation" class="fa fa-download btn btn-success btn-xs" style="width:inherit; margin-top:3px" download>'+attach+'</a>';

            }
            if (l==j){
                if (id == "9"){
                    k='<br><br><div style="margin-top:5px; float:left; clear:left;"><span class="message-data-name" style="color:silver;">'+date +'</span></div>';
                }
                else{
                k='<br><br><div style="float:right; clear:right; margin-top:5px;"><span class="message-data-name" style="color:silver;">'+
                                date +'</span></div>';}
              
            }
            if (id == "9"){
                name='<br><div><span class="message-data-name" >'+who+'</span></div>';
                if (preid==id){
                    name="";
                }
                else{
                    if(l!=1){
                    d='<div style="float:right; clear:right; margin-top:5px;"><span class="message-data-name" style="color:silver;" >'+
                                date +'</span></div>';}     
                }
                control = '<li style="width:100%">' +d+
                		            name+'<div class="msj macro">'+		
                                    '<div class="text text-l">' +
                                        '<p>'+ text +link+'</p>' +
                                    '</div>' +
                                '</div>' +k+
                                
                            '</li>';    
                preid=id;
                predate=date;

            }else{
                name='<div style="float:right"><span class="message-data-name" >'+who+'</span></div><br>';
                if (preid==id){
                    name="";
                }
                else{
                    if(l!=1){
                    d='<div style="margin-top:5px;"><span class="message-data-name" style="color:silver;">'+
                                predate +'</span></div>';}
                    
                }
                control = '<li style="width:100%;">' +d+
                				name+
                                '<div class="msj-rta macro">' +
                                    '<div class="text text-r">' +
                                        '<p style="color:black">'+text+link+'</p>' +
                                        '</div>'+
                                    '</div>' + k+                               
                          '</li>';
                preid=id;
                predate=date;
            }
            setTimeout(
                function(){                        
                    $(".chatlist").append(control).scrollTop($(".chatlist").prop('scrollHeight'));
                }, time);
            
        }
        
    </script>
<div class="box" style="position:fixed;top: 0; left: 0; z-index: 4000; height:100%; ">
    <div class="box-body" style="height:100%; ">
        <div class="row" style="height:100%;">
			<div class="col-md-9" style="width: 100%; height:100%;">

				<div class="box box-primary" style="height:100%;">
                	<div class="box-header with-border">
                        <a href="<?=base_url('dashboard')?>"><i class="fas fa-arrow-left fa-2x" style="float: left;color: white; padding: 10px">
                        </i></a>
                        <h3 class="box-title"><?=$this->lang->line('compose_new')?></h3>
                  	</div>


                  	<div class="box-body" style="padding: 0px; height:100%;display: flex; flex-direction: column;">
                        <div class="col-sm-3  frame" style="width: 94%; margin-right:3%; margin-left:3%; flex-grow: 1; background-color: #FAFBFB;">
                                <ul class="chatlist"></ul>
                                
                            </div>  
                    	<form role="form" method="post" enctype="multipart/form-data" >
                      		<div class="form-group <?=form_error('userGroup') ? 'has-error' : '' ?>" style="display:;">
                      			
                          		<select id="userGroup" style="display:none" class="Group form-control select2" name="userGroup">
                            		<option value="9" selected>Admin</option>
		                            <!-- <?php
		                             if($set == 3) {
		                             	$blockuser = array(1,4,3,5,6,7);
		                             }
		                            elseif ($set == 4) {
		                            	$blockuser = array(1,4,3,5,6,7);
		                            }
		                            elseif ($set == 2) {
		                            	$blockuser = array(1);
		                            }
		                              if(count($usertypes)) {
		                              	foreach ($usertypes as $key => $usertype) {
		                                	if(!in_array($usertype->usertypeID ,$blockuser)) {
		                                		echo '<option value="'.$usertype->usertypeID.'">'.$usertype->usertype.'</option>';
		                                	}
		                                }
		                              }
		                            ?> -->
                          		</select>
                          		<span class="control-label">
                              		<?php echo form_error('userGroup'); ?>
                          		</span>
                      		</div>


							<div id="classDiv" class="form-group <?=form_error('classID') ? 'has-error' : '' ?>" style="display:none;">
		                        <select id="classID" class="Group form-control select2" name="classID">
		                            <option value="0"><?=$this->lang->line('select_class')?></option>
		                        </select>
	                          	<span id="selectDiv" class="control-label">
	                              <?php echo form_error('classID'); ?>
	                          	</span>
		                    </div>

		                    <div id="sectionDiv" class="form-group <?=form_error('sectionID') ? 'has-error' : '' ?>" style="display:none;">
		                        <select id="sectionID" class="Group form-control select2" name="sectionID">
		                            <option value="0"><?=$this->lang->line('select_section')?></option>
		                        </select>
	                          	<span id="selectDiv" class="control-label">
	                              <?php echo form_error('sectionID'); ?>
	                          	</span>
		                    </div>


		                    <div id="stdDiv" class="form-group" style="display:none;">
		                        <select id="studentID" class="Group form-control select2" name="studentID[]" multiple="multiple">
		                            <option value="0"><?=$this->lang->line('select_student')?></option>
		                        </select>
								
		                        <span class="has-error" id="selectDiv">
		                            <?php echo form_error('studentID'); ?>
		                        </span>
		                    </div>


		                    <div id="adminDiv" class="form-group" style="display:none;">
	                          	<select id="systemadminID" class="Group form-control select2" name="systemadminID">
	                            	<option value="0"><?=$this->lang->line('select_admin')?></option>
	                          	</select>
		                    
		                        <span class="has-error" id="selectDiv">
		                            <?php echo form_error('systemadminID'); ?>
		                        </span>
		                    </div>

		                    <div id="teacherDiv" class="form-group" style="display:none;">
	                          	<select id="teacherID" class="Group form-control select2" name="teacherID">
	                            	<option value="0"><?=$this->lang->line('select_teacher')?></option>
	                          	</select>
		                        <span class="has-error" id="selectDiv">
									<?php echo form_error('teacherID'); ?>
		                        </span>
		                    </div>


		                    <div id="parentDiv" class="form-group" style="display:none;">
                          		<select id="parentID" class="Group form-control select2" name="parentID">
                            		<option value="0"><?=$this->lang->line('select_parent')?></option>
                          		</select>
                   
		                        <span class="has-error" id="selectDiv">
									<?php echo form_error('parentID'); ?>
		                        </span>
                      		</div>

	                      	<div id="userDiv" class="form-group" style="display:none;">
	                          	<select id="userID" class="Group form-control select2" name="userID">
	                            	<option value="0"><?=$this->lang->line('select_user')?></option>
	                          	</select>
	                       
	                        	<span class="has-error" id="selectDiv">
	                           		<?php echo form_error('userID'); ?></p>
	                        	</span>
	                      	</div>

                      		<div class="form-group <?=form_error('subject') ? 'has-error' : '' ?> " style="display:none;">
                        		<input class="form-control" name="subject" value="user message" placeholder="<?=$this->lang->line('subject')?>"/>

                        		<span class="control-label">
                              		<?php echo form_error('subject'); ?>
                          		</span>
                          	</div>
                          	
              								                            
					        <div style="float: left;display: flex;width: 100%;height:130px">
                                    <div class="form-group <?=form_error('message') ? 'has-error' : '' ?>" style="margin-bottom: 0px; margin-left: 3%;float: left; flex-grow: 1;">
                                    <textarea class="form-control" name="message" rows="1" placeholder="Type a Message"><?=set_value('message')?></textarea>
                                    <span id="showdata" style="display: none;"><input class="form-control"  id="uploadFile" placeholder="<?=$this->lang->line('choosefile');?>" disabled /></span>
                                    <span class="control-label">
                                        <?php echo form_error('message'); ?>
                                    </span>
                                    </div>

                                    <!-- <div class="col-sm-3" style="padding:0px; ">
                                        <input class="form-control"  id="uploadFile" placeholder="<?=$this->lang->line('choosefile');?>" disabled />
                                    </div> -->
                                    <div class="btn btn-info btn-file" style="height:32px; width:auto; margin-right: 5px; margin-left: 5px;">
                                    <i class="fa fa-paperclip"></i> 
                                    <input type="file" id="attachment" name="attachment"/>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 0px;float: left; margin-right: 3%;">
                                    <button type="submit" value="send" id = "send-btn" name="submit" class="btn btn-primary" style="padding-bottom: 4px;"><i class="fa fa-paper-plane"></i></button>
                                    </div>                
                                </div>                  
	                      	


                          	<!-- <div class="form-group"> -->
		                        <!-- <div class="btn btn-info btn-file">
		                          	<i class="fa fa-paperclip"></i> <?=$this->lang->line('attachment')?>
		                          	<input type="file" id="attachment" name="attachment"/>
		                        </div>
                        		<div class="col-sm-3" style="padding-left:0;">
                            		<input class="form-control"  id="uploadFile" placeholder="<?=$this->lang->line('choosefile');?>" disabled />
                        		</div> -->
                        		
                        		<!-- <div class="has-error">
                            		<p class="text-danger"> <?php if(isset($attachment_error)) echo $attachment_error; ?></p>
                        		</div>
                        		 -->
                      		<!-- </div> -->

                      		<!--<button type="submit" value="draft" name="submit" class="btn btn-warning" style="display: none;"><i class="fa fa-times"></i> <?=$this->lang->line('draft')?></button>-->


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
  	   $('.select2').select2();
    document.getElementById("attachment").onchange = function() {
        showdata.style.display="block";
        //document.getElementById("element").style.display = "block";
        document.getElementById("uploadFile").value = this.value;
    };
  	$('#studentID').select2({
    placeholder:"Select Student",
    AllowClear:true
});

  	$( "#userGroup" ).change(function() {
  		if($(this).val() == 1) {
		    $("#classDiv").hide();
		    $("#stdDiv").hide();
		    $("#teacherDiv").hide();
		    $("#parentDiv").hide();
		    $("#userDiv").hide();
		    $("#adminDiv").show();
		    $.ajax({
				type: 'POST',
				url: "<?=base_url('conversation/adminCall')?>",
				dataType: "html",
				success: function(data) {
					$('#systemadminID').html(data);
				}
		    });
  		} else if($(this).val() == 2) {
			$("#classDiv").hide();
			$("#stdDiv").hide();
			$("#adminDiv").hide();
			$("#parentDiv").hide();
			$("#userDiv").hide();
			$("#teacherDiv").show();
			$.ajax({
				type: 'POST',
				url: "<?=base_url('conversation/teacherCall')?>",
				dataType: "html",
				success: function(data) {
					$('#teacherID').html(data);
				}
			});
		} else if($(this).val() == 3) {
			$("#classDiv").show();
			$("#sectionDiv").show();
			$("#stdDiv").show();
			$("#adminDiv").hide();
			$("#teacherDiv").hide();
			$("#userDiv").hide();
			$("#parentDiv").hide();
			$.ajax({
				type: 'POST',
				url: "<?=base_url('conversation/classCall')?>",
				dataType: "html",
				success: function(data) {
					$('#classID').html(data);
				}
			});
		} else if($(this).val() == 4) {
			$("#classDiv").show();
			$("#sectionDiv").hide();
			$("#stdDiv").hide();
			$("#adminDiv").hide();
			$("#parentDiv").hide();
			$("#teacherDiv").hide();
			$("#userDiv").hide();
			$("#parentDiv").show();
			$.ajax({
				type: 'POST',
				url: "<?=base_url('conversation/classCall')?>",
				dataType: "html",
				success: function(data) {
					$('#classID').html(data);
				}
			});
		
  		} else {
			var id = $(this).val();
			$("#classDiv").hide();
			$("#stdDiv").hide();
			$("#sectionDiv").hide();
			$("#adminDiv").hide();
			$("#parentDiv").hide();
			$("#teacherDiv").hide();
			$("#parentDiv").hide();
			$("#userDiv").show();
			$.ajax({
				type: 'POST',
				url: "<?=base_url('conversation/userCall')?>",
				data : {id : id},
				dataType: "html",
				success: function(data) {
					$('#userID').html(data);
				}
			});
		}
	});

	$('#classID').change(function(event) {
	    var classID = $(this).val();
	   
	    if(classID === '0') {
	        $('#studentID').val(0);
	        $('#sectionID').val(0);
	        $('#parentID').val(0);
	    } else {
	        $.ajax({
	            type: 'POST',
	            url: "<?=base_url('conversation/call_all_student')?>",
	            data: "id=" + classID,
	            dataType: "html",
	            success: function(data) {
	               $('#studentID').html(data);
	            }
	        });
	        $.ajax({
	        	type: 'POST',
                url: "<?=base_url('routine/sectioncall')?>",
                data: "id=" + classID,
                dataType: "html",
                success: function(data) {
                	$('#sectionID').html(data);
                }
            });
            $.ajax({
	            type: 'POST',
	            url: "<?=base_url('conversation/call_all_student_parent')?>",
	            data: "id=" + classID,
	            dataType: "html",
	            success: function(data) {
	            	$('#parentID').html(data);
	            }
	        });
	    }
	});
	// $('#classID').change(function(event) {
	//     var classID = $(this).val();
 //         if(classID === '0') {
 //         	$('#parentID').val(0);
         	
 //         } else {
	//     	$.ajax({
	//             type: 'POST',
	//             url: "<?=base_url('conversation/call_all_student_parent')?>",
	//             data: "id=" + classID,
	//             dataType: "html",
	//             success: function(data) {
	//             	$('#parentID').html(data);
	//             }
	//         });
	//     }
	// });
	$('#sectionID').change(function(event) {
	    var sectionID = $(this).val();	
         if(sectionID === '0') {
         	$('#studentID').val(0);
         } else {
	    	$.ajax({
	            type: 'POST',
	            url: "<?=base_url('conversation/call_section_student')?>",
	            data: "id=" + sectionID,
	            dataType: "html",
	            success: function(data) {
	            	$('#studentID').html(data);
	            }
	        });
	    }
	});
</script>

<?php if($GroupID != 0) { ?>
<script>

	var GroupID = "<?=$GroupID?>";

  	if(GroupID == 1) {
	    $("#classDiv").hide();
	    $("#stdDiv").hide();
	    $("#teacherDiv").hide();
	    $("#parentDiv").hide();
	    $("#userDiv").hide();
	    $("#adminDiv").show();
	    $.ajax({
			type: 'POST',
			url: "<?=base_url('conversation/adminCall')?>",
			dataType: "html",
			success: function(data) {
				$('#systemadminID').html(data);
			}
	    });
  	} else if(GroupID == 2) {
		$("#classDiv").hide();
		$("#stdDiv").hide();
		$("#adminDiv").hide();
		$("#parentDiv").hide();
		$("#userDiv").hide();
		$("#teacherDiv").show();
		$.ajax({
			type: 'POST',
			url: "<?=base_url('conversation/teacherCall')?>",
			dataType: "html",
			success: function(data) {
				$('#teacherID').html(data);
			}
		});
	} else if(GroupID == 3) {
		$("#classDiv").show();
		$("#stdDiv").show();
		$("#adminDiv").hide();
		$("#teacherDiv").hide();
		$("#userDiv").hide();
		$("#parentDiv").hide();
		$.ajax({
			type: 'POST',
			url: "<?=base_url('conversation/classCall')?>",
			dataType: "html",
			success: function(data) {
				$('#classID').html(data);
			}
		});
	} else if(GroupID == 4) {
		$("#classDiv").hide();
		$("#stdDiv").hide();
		$("#adminDiv").hide();
		$("#parentDiv").hide();
		$("#teacherDiv").hide();
		$("#userDiv").hide();
		$("#parentDiv").show();
		$.ajax({
			type: 'POST',
			url: "<?=base_url('conversation/parentCall')?>",
			dataType: "html",
			success: function(data) {
				$('#parentID').html(data);
			}
		});
  	} else {
		var id = $(this).val();
		$("#classDiv").hide();
		$("#stdDiv").hide();
		$("#adminDiv").hide();
		$("#parentDiv").hide();
		$("#teacherDiv").hide();
		$("#parentDiv").hide();
		$("#userDiv").show();
		$.ajax({
			type: 'POST',
			url: "<?=base_url('conversation/userCall')?>",
			data : {id : id},
			dataType: "html",
			success: function(data) {
				$('#userID').html(data);
			}
		});
	}

</script>
<?php } ?>