/**
 * Created by TomLiu on 9/04/2016.
 */

    //ajax for search by location
$(document).ready(function () {
    $('#searchBtn').click(function(e){
        e.preventDefault();
        var keywords = $("#keyword").val();
        console.log(keywords);
        jQuery.ajax({
            url: '<?= base_url()?>index.php/Welcome/searchByLocation',
            dataType: 'json',
            data: keywords,
            type: 'POST',
            success: function (data) {
                var result = JSON.parse(data);
                if (result) {
                    var tableContent="";
                    var finalTableContent="";
                    for (var i = 0; i < $result.length; i++) {
                        $eventDatetime = result[i].event_datetime;
                        $eventDate = $eventDatetime.getDay().toString()+"/"
                            +$eventDatetime.getMonth().toString()+"/"+$eventDatetime.getFullYear().toString();
                        $eventTime = $eventDatetime.getHours().toString()+$eventDatetime.getMinutes().toString()
                            +$eventDatetime.getSeconds().toString();
                        var trForDate = "<tr colspan=3>"+"<td>" + $eventDate +"</td> </tr>" ;
                        var trForRest = "<tr ><td>"+ $eventTime +"</td><td>"+ result[i].book_title +"<br>"+
                            result[i].name +"<br>"+result[i].venue_address +"<br>"+result[i].listener_count +"</td></tr>";
                        tableContent = trForDate+trForRest;

                    }
                    finalTableContent += tableContent;
                    $("$ajaxResTable").append(finalTableContent);
                }
            },
            error:function(jqXHR,textStatus,errorThrown){
                alert("error",errorThrown);
            }

        });
    });
});

