export default () => {
    // return `Yo yo - welcome to Encore!`;

    const xValues = [1,104,241,318,406,518,615,701,822,914,1018,1116,1200,1307,1411,1502,1603,1723,1814,
        1864,1900,1920,1940,1960,1980,1990,2000,2010,2020,2022];
    const yValues = [276.6,277.5,280.25,281.69,279.13,276.79,277.87,277.10,278.62,280.11,279.80,282.84,
        284.54,281.58,279.70,283.12,275.07,277.64,284.43,286.65,294.22,301.92,310.38,316.91,338.7,353.99,
        369.38,389.94,413.94,418.22];

    new Chart("myChart", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                fill: false,
                lineTension: 0,
                backgroundColor: "rgba(0,0,255,1.0)",
                borderColor: "rgba(0,0,255,0.1)",
                data: yValues
                }]
            },
        options: {
            legend: {display: false},
            scales: {
                yAxes: [{ticks: {min: 200, max:500}}],
            }
        }
    });

    // return Chart;
}
