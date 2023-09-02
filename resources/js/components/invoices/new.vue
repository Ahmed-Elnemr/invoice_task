<template>
    <!--==================== NEW INVOICE ====================-->
    <div class="container">
        <!-- <div class="invoices"> -->

        <div class="card__header">
            <div>
                <h2 class="invoice__title">New Invoice</h2>
            </div>
            <div></div>
        </div>

        <div class="card__content">
            <div class="card__content--header">
                <div>
                    <p class="my-1">Customer</p>
                    <select name="" id="" class="input" v-model="customer_id" >
                        <option disabled> Select Customer</option>
                        <option :value="customer.id" v-for="customer in customers" :key="customer.id"> {{customer.name}}</option>
                    </select>
                </div>
                <div>
                    <p class="my-1">Date</p>
                    <input
                        v-model="form.date"
                        id="date"
                        placeholder="dd-mm-yyyy"
                        type="date"
                        class="input"
                    />
                </div>

            </div>
            <br /><br />
            <div class="table">
                <div class="table--heading2">
                    <p>Category Name</p>
                    <p>Unit Price</p>
                    <p>Qty</p>
                    <p>Total</p>
                    <p></p>
                </div>

                <!-- item 1 -->
                <div class="table--items2" v-for="itemCart in listCart" :key="itemCart.id" >
                    <p># {{ itemCart.id }}- {{ itemCart.name }}</p>
                    <p>
                        <input type="text" class="input"  v-model="itemCart.unit_price"/>
                    </p>
                    <p>
                        <input  type="number" min="1"  class="input"  v-model=" itemCart.quantity" />
                    </p>
                    <p v-if="itemCart.quantity">{{ (itemCart.quantity*itemCart.unit_price) }}</p>
                    <p v-else></p>
                    <p style="color: red; font-size: 24px; cursor: pointer" @click="removeItem(i)">
                        &times;
                    </p>
                </div>
                <div style="padding: 10px 30px !important">
                    <button class="btn btn-sm btn__open--modal" @click="openModal()">
                        Add New Category +
                    </button>
                </div>
            </div>

            <div class="table__footer">
                <div>
                    <div class="table__footer--total">
                        <p> Total</p>
                        <span>{{Total()}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card__header" style="margin-top: 40px">
            <div></div>
            <div>
                <a class="btn btn-secondary" @click="onSave()"> Save </a>
            </div>
        </div>

        <br>
        <br>
        <br>
             <!--==================== add modal items ====================-->
             <div class="modal main__modal " :class="{show:showModal}">
                <div class="modal__content">
                    <span class="modal__close btn__close--modal" @click="closeMOdal()">×</span>
                    <h3 class="modal__title">Add Category</h3>
                    <hr><br>
                    <div class="modal__items">
                        <ul style="list-style">
                            <li v-for="(item,i ) in listCategories" :key="item.id">
                                <span>{{ i+1 }}</span><span>-</span>
                                <a href="#">  {{ item.name }}</a>
                                <span>   &#160;&#160;&#160;&#160; &#160;&#160;&#160;&#160;</span>
                                <button type="button" class="btn btn-primary" @click="addCart(item)">
                                  Add  +
                                </button>

                                <span><hr></span>

                                <br>
                            </li>
                        </ul>
                    </div>
                    <br>
                    <hr>
                    <div class="model__footer">
                        <button class="btn btn-light mr-2 btn__close--modal" @click="closeMOdal()" >
                            Cancel
                        </button>
                        <button class="btn btn-light btn__close--modal ">Save</button>
                    </div>
                </div>
            </div>

    </div>
</template>

<script setup>
// import { stringify } from 'postcss';
import axios from 'axios';
import { onMounted ,ref } from 'vue';
import router from '../../router';
let defaultNum=ref([1])
let customers=ref([])
let customer_id=ref([])
let form=ref([])
let item=ref([])
let listCart=ref([])
const showModal =ref(false)
const hideModal=ref(true)
const listCategories=ref([])


onMounted(async() => {

  indexForm();
  allCustomer();
  getCategories();

})
// ########  get all customer  ##########
const allCustomer = async ()=>{
    let response=await axios.get("/api/get_all_customers")
    console.log('customers',response.data)
    customers.value=response.data.customers;
}


//#######  form  data  #####
const indexForm=async ()=>{
    let respone=await axios.get("/api/create_invoice")
    console.log('form',respone.data)
    form.value=respone.data
}


// ########  modal  ######
const openModal=()=>{
    showModal.value=!showModal.value;

}

const closeMOdal=()=>{
    showModal.value=!hideModal.value;
}


///###########  get all Categories #########
const getCategories =async ()=>{
    let response =await axios.get('/api/get_categories')
    console.log('categories',response.data.categories)
    listCategories.value=response.data.categories
}

//
const addCart=(item)=>{

    const itemCart ={
        id:item.id,
        name:item.name,
        unit_price:item.unit_price,
        quantity:item.quantity
    }
    listCart.value.push(itemCart);
    closeMOdal();
}




/// remove ite when click
const removeItem=(i)=>{
    listCart.value.splice(i,1)
}
////

const Total =()=>{
    let total =0;
    listCart.value.map((data)=>{
        total =total + (data.quantity*data.unit_price)
    })
    return total;
}
///
const onSave =()=>{

    if (listCart.value.length >=1) {
    let total =0
    total=Total()
        const formData = new FormData()
        formData.append('invoice_items', JSON.stringify(listCart.value))
        formData.append('customer_id', customer_id.value)
        formData.append('date', form.value.date)
        formData.append('total', total)

        axios.post('/api/add_invoice',formData)
        listCart.value=[]
        router.push('/invoice/index')
    }
}


</script>

<style></style>
