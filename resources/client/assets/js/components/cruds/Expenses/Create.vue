<template>
    <section class="content-wrapper" style="min-height: 960px;">
        <section class="content-header">
            <h1>Expenses</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <form @submit.prevent="submitForm" novalidate>
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Create</h3>
                            </div>

                            <div class="box-body">
                                <back-buttton></back-buttton>
                            </div>

                            <bootstrap-alert />

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="title">Amount *</label>
                                    <input
                                            type="text"
                                            class="form-control"
                                            name="amount"
                                            placeholder="Enter Amount *"
                                            :value="item.amount"
                                            @input="updateTitle"
                                            >
                                </div>
								
								<div class="form-group">
                                    <label for="name">Categories *</label>
                                    <v-select
                                            name="category_id"
                                            label="name"
                                            @input="updateCategories"
                                            :value="item.id"
                                            :options="categoriesAll"
                                            />
                                </div>
                                
                            </div>

                            <div class="box-footer">
                                <vue-button-spinner
                                        class="btn btn-primary btn-sm"
                                        :isLoading="loading"
                                        :disabled="loading"
                                        >
                                    Save
                                </vue-button-spinner>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </section>
</template>


<script>
import { mapGetters, mapActions } from 'vuex'

export default {
    data() {
        return {
            // Code...
			
        }
    },
    computed: {
        ...mapGetters('ExpensesSingle', ['item', 'loading', 'categoriesAll'])
    },
    created() {
        this.fetchCategoriesAll()
    },
    destroyed() {
        this.resetState()
    },
    methods: {
        ...mapActions('ExpensesSingle', ['storeData', 'resetState', 'setTitle', 'setCategories', 'fetchCategoriesAll']),
        updateTitle(e) {
			console.log(e);
            this.setTitle(e.target.value)
        },
        updateCategories(value) {
			console.log(value.id); 
            this.setCategories(value)
        },
        submitForm() {
            this.storeData()
                .then(() => {
                    this.$router.push({ name: 'expenses.index' })
                    this.$eventHub.$emit('create-success')
                })
                .catch((error) => {
                    console.error(error)
                })
        }
    }
}
</script>


<style scoped>

</style>
