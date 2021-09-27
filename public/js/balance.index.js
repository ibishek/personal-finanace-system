let labels = [];
let amount = [];
let colors = [];

$("table>tbody>tr").each(function () {
    labels.push($(this).children("td:nth-child(2)").text().trim());
    amount.push($(this).children("td:nth-child(3)").attr("data-amount"));
});

labels.forEach(() => {
    colors.push(
        "#" + ((Math.random() * 0xffffff) << 0).toString(16).padStart(6, "0")
    );
});

const data = {
    labels: labels,
    datasets: [
        {
            label: "Current Balances",
            data: amount,
            backgroundColor: colors,
        },
    ],
};

const config = {
    type: "bar",
    data: data,
    options: {
        scales: {
            y: {
                beginAtZero: true,
            },
        },
    },
};

const barChart = new Chart(document.getElementById("bar-index"), config);
