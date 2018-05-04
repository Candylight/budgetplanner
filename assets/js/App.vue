<template>
    <div class="container">
        <nav>
            <ul class="nav nav-justified">
                <li class="active"><router-link :to="{ name: 'GoalList' }" class="active">Goals</router-link></li>
                <li class="active"><router-link :to="{ name: 'BudgetList' }" class="active">Budgets</router-link></li>
                <li class="active"><router-link :to="{ name: 'BudgetCategoryList' }" class="active">Category</router-link></li>
                <li class="active"><router-link :to="{ name: 'IncomeList' }" class="active">Income</router-link></li>
                <li class="active"><router-link :to="{ name: 'ExpenseList' }" class="active">Expense</router-link></li>

            </ul>
        </nav>

        <div>
            <router-view></router-view>
        </div>
    </div>
</template>