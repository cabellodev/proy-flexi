$(()=>{
    open_close_chat();
    chat_room ();
    get_message();
});



open_chat =()=>{
    
    localStorage.setItem("activate",1);
    $(".chat-box").show();
    $(".buttom-comment").css('display','none');
    $("#message").prop('disabled', false);
    $("#btn_send").prop('disabled', false);
 
}

close_chat =()=>{
    localStorage.setItem("activate",0);
    $(".chat-box").css('display','none');
    $(".buttom-comment").show();
    $("#message").prop('disabled', true);
    $("#btn_send").prop('disabled', true);

   
}

$(".buttom-comment").on('click', open_chat);
$("#min").on('click',close_chat);


open_close_chat=()=>{
   let value= localStorage.getItem("activate");
   if(value==1){
    $(".chat-box").show();
    $(".buttom-comment").css('display','none');
 
    }else{
        $(".chat-box").css('display','none');
        $(".buttom-comment").show();

    }
}


chat_room =()=>{

let session= localStorage.getItem("session_active");

if(session){
    if(session != 0){
    $(".intro-chat").css('display','none');
    $(".intro-room").show();
    $("#message").prop('disabled', false);
    $("#btn_send").prop('disabled', false);

    }else{
        close_room();
    }
}else{
    close_room();
}

}


close_room=()=>{
    
     let data = { id_chat: localStorage.getItem("session_active")};
    console.log(data);
    $.ajax({
		type: "POST",
        data:{data},
		url: host_url + 'api/chat/close',
		crossOrigin: false,
		dataType: "json",
		success: () => {
           localStorage.setItem("session_active",0);
           $(".intro-chat").show();
           $(".intro-room").css('display','none');
           $("#message").prop('disabled', true);
           $("#btn_send").prop('disabled', true);
       
			}
        })
}

$("#begin_chat").on('click',chat_room);
$("#close_room").on('click',close_room);


validation_login =()=>{

    let data = {
        name:$("#nickname_login").val(),
        email:$("#email_login").val(),
    }

    $.ajax({
		type: "POST",
        data:{data},
		url: host_url + 'api/chat/validation',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            $(".intro-room").empty();
            localStorage.setItem("session_active",result[0].id);
            chat_room();
			}
        });
  
}


send_message=()=>{
    let data = {
        text:$("#message").val(),
        chat_id:localStorage.getItem("session_active"),
    }

    $.ajax({
		type: "POST",
        data:{data},
		url: host_url + 'api/chat/message/client',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            $("#message").val(''),
            chat_room();
            get_message();
			}
        });

}



get_message=()=>{
    let id = localStorage.getItem("session_active");

    $.ajax({
		type: "GET",
		url: host_url + `api/chat/get/messages/${id}`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
             render_messages(result);
			}
        });

}

render_messages=(messages)=>{
   
    $(".intro-room").empty();
    
    messages.forEach(element =>{
        if(element.receive == 1){
             html= `  <div class="d-flex flex-row justify-content-start"> 
                            <div class="client-message">
                                <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">${element.message}</p>
                                <p class="small ms-3 mb-3 rounded-3 text-muted">${element.date}</p>
                            </div>
                      </div>`

        }else{
            html= ` <div class="d-flex flex-row justify-content-end mb-4 pt-1 text-end">
                            <div class="admin-message">
                                    <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">${element.message}</p>
                                    <p class="small me-3 mb-3 rounded-3 text-muted d-flex justify-content-end">${element.date}</p>
                            </div>
                     </div>`
             
        }
        $(".intro-room").append(html);
    
    })

   
};




$("#btn_validate").on('click',validation_login);
$("#btn_send").on('click',send_message);























