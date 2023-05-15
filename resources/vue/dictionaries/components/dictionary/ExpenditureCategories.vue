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
                    <th>Akcja</th>
                </tr>
            </thead>
            <tbody v-if="!isLoading">
                <tr
                    v-for="(category, index) in expenditureCategories"
                    :key="index"
                >
                    <td>{{ index + 1 }}</td>
                    <td>
                        <template v-if="category.is_edit">
                            <b-form-input v-model="category.name"/>
                        </template>
                        <template v-else>
                            {{ category.name }}
                        </template>
                    </td>
                    <td>
                        <b-button
                            variant="warning"
                            @click="toggleIsEdit(index)"
                            :disabled="isSaving"
                        >
                            <template v-if="!category.is_edit">
                                Edytuj
                            </template>
                            <template v-else>
                                Anuluj
                            </template>
                        </b-button>
                        <b-button
                            v-if="category.is_edit"
                            variant="success"
                            @click="updateExpenditureCategory(index)"
                            :disabled="isSaving"
                        >
                            Zapisz
                        </b-button>
                        <b-button
                            v-else
                            variant="danger"
                            @click="deleteExpenditureCategory(index)"
                            :disabled="isSaving"
                        >
                            Usuń
                        </b-button>
                    </td>
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
                isLoading: false,
                isSaving: false,
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
            },
            deleteExpenditureCategory: function(index) {
                if (this.isSaving) {
                    return;
                }
                this.isSaving = true;

                let expenditureCategory = this.expenditureCategories[index];

                return axios.post('/dictionaries/expenditure-categories/' + expenditureCategory.id + '/delete')
                    .then((response) => {
                        this.$toast.success(response.data.message);
                        this.getExpenditureCategories();
                    }).catch(error => {
                        this.$toast.error(error.response.data.message);
                    }).finally(() => {
                        this.isSaving = false;
                    });
            },
            updateExpenditureCategory: function(index) {
                if (this.isSaving) {
                    return;
                }
                this.isSaving = true;

                let expenditureCategory = this.expenditureCategories[index];

                return axios.post('/dictionaries/expenditure-categories/' + expenditureCategory.id + '/update', {
                    name: expenditureCategory.name
                })
                    .then((response) => {
                        this.$toast.success(response.data.message);
                        this.getExpenditureCategories();
                    }).catch(error => {
                        this.$toast.error(error.response.data.message);
                    }).finally(() => {
                        this.isSaving = false;
                    });
            },
            toggleIsEdit: function(index) {
                this.expenditureCategories[index].is_edit = !this.expenditureCategories[index].is_edit;
                this.$forceUpdate();
            }
        },
        mounted() {
            this.getExpenditureCategories();
        }
    }
</script>
