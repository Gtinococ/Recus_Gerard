window.onload = function() { init(event); };

function init(){

    var script_tag = document.getElementById('functions')
    var user_id = script_tag.getAttribute("user-id");
    var n1 = $(".n1").val(Math.floor(Math.random()* 100));
    var nSuma = $(".nSuma");

    $(".btn").click(function(event){
        event.preventDefault();

        var _token = $('meta[name=csrf-token]').attr('content');
        var to = "public";
        var from = user_id;
        n1 = $(".n1").val();


        $.ajax({
            url: "https://dawjavi.insjoaquimmir.cat/gtinoco/curs2021/recus/Recus_Gerard_Tinoco/public/send",
            type:"POST",
            data: {_token:_token, message:n1, to:to, from:from},
            success:function(data){
                console.log("todo corrcto")
                n1 = $(".n1").val(Math.floor(Math.random()* 100));

            }
        })
    });

    Echo.private('public').listen('NewMessageNotification', (e) => {
        console.log(e.message.message);
        nSuma.prepend("<h1>"+e.message.message+"</h1>");
    });
}


