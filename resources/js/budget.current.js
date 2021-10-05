"use strict";
const amounts = [
    document.getElementById("spendings").getAttribute("data-amount"),
    document.getElementById("savings").getAttribute("data-amount"),
];
const budgetTitle = document.getElementById("budget-title").textContent;

const budgetData = {
    labels: ["Spendings", "Savings"],
    datasets: [
        {
            label: "Current Budget",
            data: amounts,
            backgroundColor: ["#cf212b", "#42bbe0"],
        },
    ],
};

const budgetConfig = {
    type: "doughnut",
    data: budgetData,
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

const doughnutChart = new Chart(
    document.getElementById("current-budget"),
    budgetConfig
);

const daysLabels = ["Budget Duration", "Reaminig Days"];
const daysDatas = [$("#total-days").text(), $("#remaining-days").text()];
const colors = ["#278ecf", "#4bd762"];
let i = 0;
const data = {
    labels: daysLabels,
    datasets: [
        {
            label: "Days",
            data: daysDatas,
            backgroundColor: colors,
        },
    ],
};

const daysConfig = {
    type: "bar",
    data: data,
    options: {
        indexAxis: "y",
        responsive: true,
        plugins: {
            legend: {
                display: false,
            },
            title: {
                display: true,
                text: "Total Days/Remaining Days",
            },
        },
    },
};

const lineCahrt = new Chart(document.getElementById("line-chart"), daysConfig);
