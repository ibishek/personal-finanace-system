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
            // const expRemainingAmount =
            //     data[0].alloted_amount - currentBudgetExpense;
            // expenseData.datasets[0].data = data[0].alloted_amount;
            // second.push(currentBudgetExpense);
            // second.push(expRemainingAmount);
            // console.log(expenseData.datasets, second);
            // expenseData.datasets[1].data = second;
            // expenseChart.update();
        },
    });

    // % of Income
    // % of Expense
    let first = []; //#5969ff, #fe407a, #bff2fb
    let second = [];
    const data = {
        labels: ["Red"],
        datasets: [
            {
                label: "Dataset 1",
                data: 45000,
                backgroundColor: "#5969ff",
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
                    text: "Current Expenses % of Budget",
                },
            },
        },
    };

    const expenseChart = new Chart(
        document.getElementById("percent-of-expense"),
        config
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
