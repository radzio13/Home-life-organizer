<template>
    <div class="container">
        <h4>Kategorie wydatków</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Lp.</th>
                    <th>Nazwa</th>
                </tr>
            </thead>
            <tbody v-if="!isLoading">
                <tr
                    v-for="(category, index) in expenditureCategories"
                    :key="index"
                >
                    <td>{{ index + 1 }}</td>
                    <td>{{ category.name }}</td>
                </tr>
            </tbody>
            <b-spinner v-else></b-spinner>
        </table>
    </div>
</template>

<script>
    export default {
        name: "ExpenditureCategories",
        data() {
            return {
                expenditureCategories: [],
                isLoading: false
            }
        },
        methods: {
            getExpenditureCategories() {
                this.isLoading = true;

                axios.get('/dictionaries/expenditure-categories')
                    .then(response => {
                        this.expenditureCategories = response.data.categories;
                    })
                    .catch((error) => {
                        console.log(error);
                    })
                    .finally(() => {
                        this.isLoading = false;
                    });
            }
        },
        mounted() {
            this.getExpenditureCategories();
        }
    }
</script>
