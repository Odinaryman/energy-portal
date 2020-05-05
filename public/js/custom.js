$(document).ready(function () {
    var chart_height=400;
    var chart_width=700;
    var windowsize= $(window).width();
    if (windowsize < 500 ) {
        chart_height=300;
        chart_width=400;
    }else if(windowsize < 982){
        chart_height=300;
        chart_width=572;
    }
/******************************* Ajax Load Page**********************************/

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        // close dropdowns
        $('li .active .collapse').removeClass('show');
        $('.collapse.in').toggleClass('in');
        // and also adjust aria-expanded attributes we use for the open/closed arrows
        // in our CSS
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        $('.collapse').removeClass('show');
    });


    $('ul.tabs li').click(function () {
        var tab_id = $(this).attr('data-tab');

        $('ul.tabs li').removeClass('current');
        $('.tab-content').removeClass('current');

        $(this).addClass('current');
        $("#" + tab_id).addClass('current');

        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart1);
        google.charts.setOnLoadCallback(drawChart);

        function drawChart1() {
          var data = google.visualization.arrayToDataTable(
                daily_value
            );

          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                           { calc: "stringify",
                             sourceColumn: 1,
                             type: "string",
                             role: "annotation" },
                           2]);

          var options = {
            width: chart_width,
            height: chart_height,
              vAxis:{
                  title:'Unit Consumed (kWh)'
              },
              hAxis: {
                  slantedText:true,
                  slantedTextAngle:45,
                  title:'Day'
                  //format:'MMM d, y',
                  //gridlines: { count: daily_value.length }
              },
            bar: {groupWidth: "50%"},
            legend: { position: "none" },

        };
          var chart = new google.visualization.ColumnChart(document.getElementById("chart_div"));
          chart.draw(view, options);
        }

        function drawChart() {
          var data = google.visualization.arrayToDataTable(
                monthly_value
            );

          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                           { calc: "stringify",
                             sourceColumn: 1,
                             type: "string",
                             role: "annotation" },
                           2]);
            var options = {
            width: chart_width,
            height: chart_height,
                vAxis:{
                    title:'Unit Consumed (kWh)'
                },
                hAxis: {
                    slantedText:true,
                    slantedTextAngle:45,
                    title:'Month'
                    //format:'MMM y',
                    //gridlines: { count: 4 }
                },
            bar: {groupWidth: "50%"},
            legend: { position: "none" },
          };
          var chart = new google.visualization.ColumnChart(document.getElementById("chart_div2"));
          chart.draw(view, options);
        }


    });

    $('#first').click();

    $(document).on("click", ".loadajaxpage", function (e) {
        e.preventDefault();
        $("#main_content_load").load($(this).attr("href"));
    })

    $('#other').click(function () {
        amount = null;
        $('#card').fadeOut();
        $('#other-input').fadeIn('10000');
    });


});

$(function () {
    "use strict";
    $(function () {
        $(".preloader").fadeOut();
    });
});

/************************************ Delete Record ********************************/
function deleterec(url, id, showpage) {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    swal({
        title: "Are you sure?",
        text: "Your will not be able to recover this!",
        type: "",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!"
    },
        function () {
            $.ajax({
                url: url + '/' + id,
                type: "DELETE",
                headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
                success: function (data) {
                    if (data.success) {
                        toastr.success(data.systemmessage);
                        $("#main_content_load").load(showpage);
                    }
                    else {
                        toastr.error(data.errormessage);
                    }
                }
            });
            //window.location	=	url+'/'+id;
        }
    )
}

/****************************** Form Submit *************************************/
function submitform(actionpage, formid, showpage) {
    $.post(actionpage, $("#" + formid).serialize(), function (data) {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        if (data.errors) {
            var error = data.errors;
            messageHtml = '';
            $.each(error, function (key, value) {
                messageHtml += value[0] + '</br>';
            });
            toastr.error(messageHtml);
        }
        else if (data.success) {
            if (formid == 'loginform') {
                window.location = showpage;
            }
            else {
                $("#main_content_load").load(showpage);
            }
            toastr.success(data.success);
        }
        else {
            toastr.error(data.errormessage);
        }
    });
}
var amount =null;

function collectAmount(a){
    amount=$(a).attr('data-amount');
}


function numberCheck(e,objt) {
    var keyCode = e.which ? e.which : e.keyCode;
    var arr=[8,13,37,39];
    if (!(keyCode >= 48 && keyCode <= 57) && (jQuery.inArray(keyCode, arr) == -1))return false;
}

function confirm() {

    var inputCheck = $('#other-input').val();
    var vals;
    if(inputCheck != '')vals=inputCheck;
    else if(amount!=null)vals=amount;
    else return;
    $('#confirm').text('₦'+parseInt(vals)+'.00');
    vals += '00';
    vals = parseInt(vals);
    $('#amount').val(vals);
    $('#click').click();
    inputCheck='';

}



