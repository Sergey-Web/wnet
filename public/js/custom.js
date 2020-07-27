jQuery(document).ready(function () {
    $("#search").on('click', function (event) {
        $('#error').hide();
        var query = $('#searchContract').val();
        var type = $("input[name='searchType']:checked").val();

        var status = [];

        if ($('#statusWork').is(":checked")) {
            status.push('work');
        }

        if ($('#statusConnecting').is(":checked")) {
            status.push('connecting');
        }

        if ($('#statusDisconnected').is(":checked")) {
            status.push('disconnected');
        }

        var data = {
            "query": query,
            "type": type,
            "status": status
        };

        if (Number.isInteger(+query)) {
            $.ajax({
                type: 'POST',
                url:  window.location,
                data: JSON.stringify(data),
                success: function (data) {
                    var parsedData = JSON.parse(data);
                    if (parsedData.length !== 0) {
                        $('#contract').removeAttr('hidden');
                        $('#clientName').text(parsedData[0].name);
                        $('#company').text(parsedData[0].company);
                        $('#contractNum').text(parsedData[0].number);
                        $('#dateSign').text(parsedData[0].date_sign);
                        var services = '';

                        parsedData.forEach(function(item, i, arr) {
                            services += item.title_service + '<br>';
                        });
                        $('#services').html(services);
                    }
                }
            });
        } else {
            $('#error').show();
            $('#error').text('Field search should be a number')
        }
    });
});