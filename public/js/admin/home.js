$(document).ready(function(){
    "use strict";
    var CSRF_TOKEN = $('#CSRF_TOKEN').val();
    
    var date = $('.monthPicker').val();
    totalPercent(date);
    getDebitVSCredit();

    function getDebitVSCredit(){
        $.ajax({
        type: 'POST',
        dataType : 'JSON',
        url: _baseURL+'charts/getDebitCredit',
        data: {'csrf_stream_token' : CSRF_TOKEN},
        success: function(data) {
              var month = [];
              var debit = [];
              var credit = [];

              for(var i in data) {
                month.push(data[i].month);
                debit.push(data[i].debit);
                credit.push(data[i].credit);
              }

              var chartdata = {
                labels: month,
                    datasets: [
                        {
                            label: "Debit",
                            borderColor: "rgba(55, 160, 0, 0.5)",
                            borderWidth: "1",
                            backgroundColor: "rgba(55, 160, 0, 0.5)",
                            pointHighlightStroke: "rgba(26,179,148,1)",
                            data: debit
                        },
                        {
                            label: "Credit",
                            borderColor: "rgba(0,0,0,.09)",
                            borderWidth: "1",
                            backgroundColor: "rgba(0,0,0,.07)",
                            data: credit
                        }
                    ]
              };

              var ctx = $("#accLineChart");

              var dcGraph = new Chart(ctx, {
                type: 'line',
                data: chartdata,
                options: {
                    responsive: true,
                    tooltips: {
                        mode: 'index',
                        intersect: false
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    }

                }
              });
            },
            error: function(data) {
              
            }
        });
    }

    function totalPercent(date) {
         $.ajax({
            type: 'POST',
            dataType : 'JSON',
            url: _baseURL+'charts/getPercentage',
            data: {'csrf_stream_token' : CSRF_TOKEN, date:date},
            success: function(data) {
                var pctx = document.getElementById("pieChart");
                var myChart = new Chart(pctx, {
                    type: 'pie',
                    data: {
                        datasets: [{
                                data: [data.patient.toFixed(2), data.appointment.toFixed(2), data.prescription.toFixed(2)],
                                backgroundColor: [
                                    "rgba(255,153,51,1)",
                                    "rgba(0,153,153,1)",
                                    "rgba(0,153,0,1)"
                                ],
                                hoverBackgroundColor: [
                                    "rgba(255,153,51,1)",
                                    "rgba(0,153,153,1)",
                                    "rgba(0,153,0,1)"
                                ]

                            }],
                        labels: [
                            "Patient",
                            "Appointment",
                            "Prescription"
                        ]
                    },
                    options: {
                        responsive: true
                    }
                });
            },
            error: function(data) {
              
            }
        });
    }

    // patient, appointment, prescription last year
    $.ajax({
        type: 'POST',
        dataType : 'JSON',
        url: _baseURL+'dashboard/getChart',
        data: {'csrf_stream_token' : CSRF_TOKEN},
        success: function(data) {
          var month = [];
          var patient = [];
          var appointment = [];
          var prescription = [];

          for(var i in data) {
            month.push(data[i].month);
            patient.push(data[i].patient);
            appointment.push(data[i].appointment);
            prescription.push(data[i].prescription);
          }

          var chartdata = {
            labels: month,
                datasets: [
                    {
                        label: "Patient",
                        borderColor: "#ff9933",
                        borderWidth: "1",
                        backgroundColor: "rgba(0,0,0,.07)",
                        pointHighlightStroke: "rgba(26,179,148,1)",
                        data: patient
                    },
                    {
                        label: "Appointment",
                        borderColor: "#009999",
                        borderWidth: "1",
                        backgroundColor: "rgba(0,0,0,.07)",
                        pointHighlightStroke: "rgba(26,179,148,1)",
                        data: appointment
                    },
                    {
                        label: "Prescription",
                        borderColor: "#009900",
                        borderWidth: "1",
                        backgroundColor: "rgba(0,0,0,.07)",
                        pointHighlightStroke: "rgba(26,179,148,1)",
                        data: prescription
                    }
                ]
          };

          var ctx = $("#lineChart");

          var barGraph = new Chart(ctx, {
            type: 'line',
            data: chartdata,
            options: {
                responsive: true,
                tooltips: {
                    mode: 'index',
                    intersect: false
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                }

            }
          });
        },
        error: function(data) {
          
        }
    });

    $(".monthPicker").datepicker({
        dateFormat: 'yy-mm',
        changeMonth: true,
        changeYear: true,
        yearRange: "-20:+0",
        showButtonPanel: true,

        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('yy-mm', new Date(year, month, 1)));
        }
    });

    $(".monthPicker").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });
    $('#ui-datepicker-div').on('click', '.ui-datepicker-close', function(){
        var date = $('.monthPicker').val();
        totalPercent(date);
    });

});