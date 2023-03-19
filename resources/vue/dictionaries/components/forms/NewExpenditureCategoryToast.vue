<template>
    <b-toast
        id="new-expenditure-category-toast"
        title="Dodaj nową kategorię wydatków"
        no-auto-hide
        no-close-button
        toaster="b-toaster-top-center"
    >
        <b-form>
            <b-form-group>
                <b-form-input v-model="expenditureCategory.name"/>
            </b-form-group>
            <b-form-group>
                <b-button
                    variant="primary"
                    @click=""
                >
                    Anuluj
                </b-button>
                <b-button
                    variant="success"
                    :disabled="expenditureCategory.name == '' || isSaving"
                    @click="storeNewExpenditureCategory()"
                >
                    Zapisz
                </b-button>
            </b-form-group>
        </b-form>
    </b-toast>
</template>

<script>
export default {
    name: "NewExpenditureCategoryToast",
    data() {
        return {
            expenditureCategory: {
                name: ''
            },
            isSaving: false
        }
    },
    methods: {
        hideToastAndClearData: function () {
            this.expenditureCategory.name = '';
            this.$bvToast.hide('new-expenditure-category-toast');
        },
        storeNewExpenditureCategory: function() {
            if (this.expenditureCategory.name.length <= 2) {
                return;
            }
            this.isSaving = true;

            return axios.post('/dictionaries/expenditure-categories/store', {
                name: this.expenditureCategory.name
            }).then((response) => {
                this.hideToastAndClearData();
                console.log(response.data.message); //TODO show notification
                this.$emit('refreshData');
            }).catch(error => {
                console.log(error.response.data.message);
            }).finally(() => {
                this.isSaving = false;
            });
        }
    }
}
</script>

<style scoped>

</style>
