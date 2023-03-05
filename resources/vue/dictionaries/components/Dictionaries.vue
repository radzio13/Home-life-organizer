<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Słowniki</div>
                    <div class="card-body">
                        <expenditure-categories></expenditure-categories>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ExpenditureCategories from "./dictionary/ExpenditureCategories";
    export default {
        name: "Dictionaries",
        components: {ExpenditureCategories},
    }
</script>
