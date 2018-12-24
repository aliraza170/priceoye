import Vue from 'vue'
import Vuex from 'vuex'
import Alert from './modules/alert'
import ChangePassword from './modules/change_password'
import Rules from './modules/rules'
import CategoriesIndex from './modules/Categories'
import CategoriesSingle from './modules/Categories/single'
import ExpensesIndex from './modules/Expenses'
import ExpensesSingle from './modules/Expenses/single'
import PermissionsIndex from './modules/Permissions'
import PermissionsSingle from './modules/Permissions/single'
import RolesIndex from './modules/Roles'
import RolesSingle from './modules/Roles/single'
import UsersIndex from './modules/Users'
import UsersSingle from './modules/Users/single'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
    modules: {
        Alert,
        ChangePassword,
        Rules,
        PermissionsIndex,
        PermissionsSingle,
        RolesIndex,
        RolesSingle,
		CategoriesIndex,
		CategoriesSingle,
		ExpensesIndex,
		ExpensesSingle, 
        UsersIndex,
        UsersSingle,
    },
    strict: debug,
})
