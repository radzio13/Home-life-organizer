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
                    @click="hideToastAndClearData()"
                >
                    Anuluj
                </b-button>
                <b-button
                    variant="success"
                    :disabled="disabledSaveButton"
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
    computed: {
      disabledSaveButton: function () {
          return this.expenditureCategory.name.length <= 2 || this.isSaving;
      }
    },
    methods: {
        hideToastAndClearData: function () {
            this.expenditureCategory.name = '';
            this.$bvToast.hide('new-expenditure-category-toast');
        },
        storeNewExpenditureCategory: function() {
            if (this.disabledSaveButton) {
                return;
            }
            this.isSaving = true;

            return axios.post('/dictionaries/expenditure-categories/store', {
                name: this.expenditureCategory.name
            }).then((response) => {
                this.hideToastAndClearData();
                this.$toast.success(response.data.message);
                this.$emit('refreshData');
            }).catch(error => {
                this.$toast.error(error.response.data.message);
            }).finally(() => {
                this.isSaving = false;
            });
        }
    }
}
</script>

<style scoped>

</style>
