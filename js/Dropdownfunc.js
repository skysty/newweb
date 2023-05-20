$(document).ready(function(){
    $("#hideText").hide();
    $("#univ_avtor_san2").hide();
    $("#korsetkish").change(function(){
        var kod_korsetkish = $("#korsetkish option:selected").text();
        var id_esep =$("#korsetkish option:selected").attr('id_esep');
        var id_shekteu =$("#korsetkish option:selected").attr('id_shekteu');

        if (id_shekteu <= 1) {
            $("#sany").prop('disabled', true); 
        }else {
            $("#sany").prop('disabled', false); 
        }
        if (id_shekteu <= 1) {
            $("#select_sany").prop('disabled', true); 
        }else {
            $("#select_sany").prop('disabled', false); 
        }

        if (id_esep==6){
            $("#hideText").show();
            $("#univ_avtor_san2").show();
            $("#univ_avtor_san").hide();
            $("#univ_avtor_san").prop('disabled', true);
            $("#univ_avtor_san2").val('1');
            $("#univ_avtor_san2").prop('disabled', false);
            $("#avtor_bir").show();
            $("#avtor_eki").show();
            $("#avtor_ush").show();
            $("#avtor_tort").show();
            $("#avtor_bes").show();
            $("#avtor_alty").show();
        }
        if (id_esep>=1&&id_esep<=5){
            $("#hideText").hide();
            $("#univ_avtor_san2").val('');
            $("#univ_avtor_san2").hide();
            $("#univ_avtor_san").show();
            $("#hidingElem").show();
            $('.my-class').find(':input').val('');
            $("#univ_avtor_san2").prop('disabled', true);
            $("#univ_avtor_san").prop('disabled', false);
            $("#univ_avtor_san").val(1);
            $("#avtor_bir").val('');
            $("#avtor_bir").hide();
            $("#avtor_eki").val('');
            $("#avtor_eki").hide();
            $("#avtor_ush").val('');
            $("#avtor_ush").hide();
            $("#avtor_tort").val('');
            $("#avtor_tort").hide();
            $("#avtor_bes").val('');
            $("#avtor_bes").hide();
            $("#avtor_alty").val('');
            $("#avtor_alty").hide();			

        }
        $("#select_sany").val(id_esep);									
        $("#id_esep1").val(id_esep);
        var id_comment =$("#korsetkish option:selected").attr('id_comment');
        $("#label_sany").text(id_comment);
        $.ajax({
            method:"POST",
            data:{kod_korsetkish:kod_korsetkish},
            dataType:"text",
            success:function(data){
                $("#tolyk_korset").text(kod_korsetkish);
            }
        });
    });
    

    $("#form1").submit(function( event ) {

        var id_shekteu = $("#korsetkish option:selected").attr('id_shekteu');
        var sany = $("#sany").val();

            if ( parseInt(id_shekteu) <= parseInt(sany) && !$("#sany").prop('disabled')) {
                alert("Шектік санынан асып кеттіңіз!\nқайта толтырыңыз");
            event.preventDefault();
            
        }
    
    });
    $("#select_sany").change(function(){
        var select_sany = $("#select_sany option:selected").text();
        var select_sanyID = $("#select_sany option:selected").val();
        $.ajax({
            method:"POST",
            data:{select_sany:select_sany},
            dataType:"text",
            success:function(data){
                $("#label_sany").text(select_sany);
                if(select_sanyID == 3){
                    alert("Сағат саны максимал 36");
                    $('#sany').prop('min','1');
                    $('#sany').prop('max','36');
                } else if(select_sanyID == 4){
                    alert("Шаршы см. максимал 500");
                    $('#sany').prop('min','1');
                    $('#sany').prop('max','500');
                }								
            }
        });
    });
});

