const amounts = [
    document.getElementById("spendings").getAttribute("data-amount"),
    document.getElementById("savings").getAttribute("data-amount"),
];
const budgetTitle = document.getElementById("budget-title").textContent;

const data = {
    labels: ["Spendings", "Savings"],
    datasets: [
        {
            label: "Current Budget",
            data: amounts,
            backgroundColor: ["#cf212b", "#42bbe0"],
        },
    ],
};

const config = {
    type: "doughnut",
    data: data,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: "top",
            },
            title: {
                display: true,
                text: budgetTitle,
            },
        },
    },
};

const doughnutChart = new Chart(document.getElementById("budget"), config);
