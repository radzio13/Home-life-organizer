<template>
    <div class="container">
        <h4>Kategorie wydatków</h4>
        <b-button
            variant="success"
            @click="$bvToast.show('new-expenditure-category-toast')"
        >
            Dodaj nową kategorię
        </b-button>
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
        <new-expenditure-category-toast
            @refreshData="getExpenditureCategories()"
        ></new-expenditure-category-toast>
    </div>
</template>

<script>
    import NewExpenditureCategoryToast from "../forms/NewExpenditureCategoryToast";
    export default {
        name: "ExpenditureCategories",
        components: {NewExpenditureCategoryToast},
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
                        this.$toast.error('Wystąpił błąd podczas pobierania danych');
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
