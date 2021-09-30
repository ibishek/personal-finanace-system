$(function () {
    const baseUrl = document.location.origin;
    let currentBudgetIncome, currentBudgetExpense, currentBudgetAmount;
    // Current Budget's Name
    $.ajax({
        url: `${baseUrl}/api/budgets/current/name`,
        type: "get",
        dataType: "json",
        success: (data) => {
            $("#budget-title").text(data[0].title);
        },
        error: (jqXHR, exception) => {
            if (jqXHR.status == 500) {
                $("#budget-title").text("No active budget found");
            }
        },
    });

    // Fetch data for first row
    $.ajax({
        url: `${baseUrl}/api/dashboard/general-info`,
        type: "get",
        dataType: "json",
        success: (data) => {
            currentBudgetIncome = data[0];
            $("#total-income").text(data[0]);
            currentBudgetExpense = data[1];
            $("#total-expense").text(data[1]);
            $("#total-balance").text(data[2]);
            $("#cash-on-hand").text(data[3]);
        },
    });

    // Draw current balance
    const currentBalanceData = {
        labels: ["Cash on Hand", "Credit Card"],
        datasets: [
            {
                label: "Amount: ",
                data: [37580, 62120],
                backgroundColor: ["#4c9530", "#c21bc4"],
            },
        ],
    };

    const currentBalanceConfig = {
        type: "bar",
        data: currentBalanceData,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
            plugins: {
                title: {
                    display: true,
                    text: "Current Balances",
                },
                legend: {
                    display: false,
                },
            },
        },
    };

    const barChart = new Chart(
        document.getElementById("current-balances"),
        currentBalanceConfig
    );

    let labels = [];
    let amounts = [];
    let colors = [];

    $.ajax({
        url: `${baseUrl}/api/balances/current`,
        type: "get",
        dataType: "json",
        success: (data) => {
            data.map((item) => {
                labels.push(item.title);
                amounts.push(item.amount);
                colors.push(
                    "#" +
                        ((Math.random() * 0xffffff) << 0)
                            .toString(16)
                            .padStart(6, "0")
                );
            });
            currentBalanceData.labels = labels;
            currentBalanceData.datasets[0].data = amounts;
            currentBalanceData.datasets[0].backgroundColor = colors;
            barChart.update();
        },
    });

    $.ajax({
        url: `${baseUrl}/api/budgets/current/amount`,
        type: "get",
        dataType: "json",
        success: (data) => {
            let expRemainingAmount;
            if (data[0].alloted_amount > currentBudgetIncome) {
                incData.datasets[0].data = data[0].alloted_amount;
                incomeData.push(data[0].alloted_amount);
                incomeData.push(currentBudgetIncome);
                incomeLabels = ["Budget Amount", "Total Income Amount"];
                incomeColors = ["#5969ff", "#43a047"];
                incData.labels = incomeLabels;
                incData.datasets[1].backgroundColor = incomeColors;
                incChart.update();
            } else {
                incData.datasets[0].data = currentBudgetIncome;
                incomeData.push(currentBudgetIncome);
                incomeData.push(data[0].alloted_amount);
                incomeLabels = ["Total Income Amount", "Budget Amount"];
                incomeColors = ["#43a047", "#5969ff"];
                incData.labels = incomeLabels;
                incData.datasets[1].backgroundColor = incomeColors;
                incChart.update();
            }
            expRemainingAmount = data[0].alloted_amount - currentBudgetExpense;
            expData.datasets[0].data = data[0].alloted_amount;
            second.push(expRemainingAmount);
            second.push(currentBudgetExpense);
            expData.datasets[1].data = second;
            expChart.update();
        },
    });

    let incomeData = []; //#5969ff, #fe407a, #bff2fb
    let incomeLabels = [];
    let incomeColors = [];
    let second = [];

    // % of Income
    const incData = {
        labels: ["Remaining", "Expense"],
        datasets: [
            {
                label: "Dataset 1",
                data: [81000],
                backgroundColor: ["#bff2fb"],
            },
            {
                label: "Dataset 1",
                data: [75000, 6000],
                backgroundColor: ["#5969ff", "#43a047"],
            },
        ],
    };

    const incConfig = {
        type: "doughnut",
        data: incData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                },
                title: {
                    display: false,
                    text: "% of Income",
                },
            },
        },
    };

    const incChart = new Chart(
        document.getElementById("percent-of-income"),
        incConfig
    );

    // % of Expense
    const expData = {
        labels: ["Remaining", "Expense"],
        datasets: [
            {
                label: "Dataset 1",
                data: [81000],
                backgroundColor: ["#bff2fb"],
            },
            {
                label: "Dataset 1",
                data: [75000, 6000],
                backgroundColor: ["#5969ff", "#fe407a"],
            },
        ],
    };

    const expConfig = {
        type: "doughnut",
        data: expData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                },
                title: {
                    display: false,
                    text: "% of Income",
                },
            },
        },
    };

    const expChart = new Chart(
        document.getElementById("percent-of-expense"),
        expConfig
    );

    //Previous Budgets
    const previousBudgetData = {
        labels: ["Budget 1", "Budget 2", "Budget 3"],
        datasets: [
            {
                label: "Budget Amount: ",
                data: [62120, 78000, 54000],
                backgroundColor: ["#005C81"],
            },
            {
                label: "Savings: ",
                data: [37580, 45000, 12000],
                backgroundColor: ["#3e8739"],
            },
        ],
    };

    const previousBudgetConfig = {
        type: "bar",
        data: previousBudgetData,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
            plugins: {
                title: {
                    display: true,
                    text: "Previous Budgets Amount and Savings Status",
                },
                legend: {
                    display: false,
                },
            },
        },
    };

    const previousBudgetBarChart = new Chart(
        document.getElementById("previus-budgets"),
        previousBudgetConfig
    );

    let preLabels = [];
    let allotd = [];
    let balance = [];

    $.ajax({
        url: `${baseUrl}/api/budgets/previous`,
        type: "get",
        dataType: "json",
        success: (data) => {
            data.map((item) => {
                preLabels.push(item.title);
                allotd.push(item.alloted_amount);
                balance.push(item.balance_amount);
            });
            previousBudgetData.labels = preLabels;
            previousBudgetData.datasets[0].data = allotd;
            previousBudgetData.datasets[1].data = balance;
            previousBudgetBarChart.update();
        },
    });

    // Latest Income Transaction
    $.ajax({
        url: `${baseUrl}/api/transactions/ten-income`,
        type: "get",
        dataType: "json",
        success: (data) => {
            data.map((item, index) => {
                let tableRow = document.createElement("tr");
                let sn = document.createElement("td");
                sn.appendChild(document.createTextNode(`${index + 1}`));
                tableRow.appendChild(sn);
                let title = document.createElement("td");
                title.appendChild(document.createTextNode(`${item.title}`));
                tableRow.appendChild(title);
                let amount = document.createElement("td");
                amount.appendChild(document.createTextNode(`${item.amount}`));
                tableRow.appendChild(amount);
                $("table#income>tbody").append(tableRow);
            });
        },
    });

    // Latest Expense Transaction
    $.ajax({
        url: `${baseUrl}/api/transactions/ten-expense`,
        type: "get",
        dataType: "json",
        success: (data) => {
            data.map((item, index) => {
                let tableRow = document.createElement("tr");
                let sn = document.createElement("td");
                sn.appendChild(document.createTextNode(`${index + 1}`));
                tableRow.appendChild(sn);
                let title = document.createElement("td");
                title.appendChild(document.createTextNode(`${item.title}`));
                tableRow.appendChild(title);
                let amount = document.createElement("td");
                amount.appendChild(document.createTextNode(`${item.amount}`));
                tableRow.appendChild(amount);
                $("table#expense>tbody").append(tableRow);
            });
        },
    });
});
