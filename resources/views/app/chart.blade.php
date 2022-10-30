 {{-- javascript for admin dashboard chart --}}
                <script>
                    window.onload = function () {

                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    theme: "dark1",
                    title:{
                        text: "عدد المنشورات في آخر 5 سنوات"
                    },
                    axisX: {
                        title: "السنة"
                    },
                    axisY: {
                        title: "عدد المنشورات"
                    },
                    data: [{
                        type: "column",
                        dataPoints: [
                            { y: {{ $year1 }}, label: {{ $currentYear-4 }} },
                            { y: {{ $year2 }}, label: {{ $currentYear-3 }} },
                            { y: {{ $year3 }}, label: {{ $currentYear-2 }} },
                            { y: {{ $year4 }}, label: {{ $currentYear-1 }} },
                            { y: {{ $year5 }}, label: {{ $currentYear }} },
                        ]
                    }]
                });
                chart.render();
                }
                </script>
