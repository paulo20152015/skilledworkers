<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Companies</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <button v-if="archivecompany == 'not-archive'" class="nav-link btn" type="button" data-toggle="modal" data-target="#modalCreateCompany">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Account
                        </button>
                    </li>
                    <li v-if="archivecompany == 'not-archive'" class="nav-item"><a class="nav-link" @click="showFilters()" href="#">{{filterFlag == 0?'Show filter':'Hide filter'}}</a></li>
                </ul>
            </div>
        </nav>
        <!--search bar-->
        <transition  enter-active-class="animated slideInDown" leave-active-class="animated slideOutLeft">
        <div class="jumbotron" v-if="filterFlag==1">
            <h3>Ordering and Sorting Contents</h3>
            <div class="row" >

                <div class="col-lg-6 offset-lg-3  ">
                    <div class="input-group">
                        <input class="form-control "  type="search"  @keyup='getCompanies()' @keyup.delete="getCompanies()"  @keyup.ctrl='getCompanies()' v-model="search"  placeholder="keyword search company name,number etc" aria-label="Search">
                        <div class="input-group-prepend">
                            <button class="btn input-group-text" type='button' @click="getCompanies()">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <p class="col-lg-12">Order By: </p>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="staticEmail" class="col-sm-10 col-form-label">Alphabetically :</label>
                        <div class="col-sm-10">
                            <select  class="form-control" @change='getCompanies()' v-model="orderFilter[0].value" >
                                <option value='0' selected>none</option>
                                <option value='1'>Ascending</option>
                                <option value='2'>Descending</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="staticEmail" class="col-sm-10 col-form-label">Last Login :</label>
                        <div class="col-sm-10">
                            <select  class="form-control" @change='getCompanies()' v-model="orderFilter[1].value" >
                                <option value='0' selected>none</option>
                                <option value='1'>Recent</option>
                                <option value='2'>Oldest</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="staticEmail" class="col-sm-10 col-form-label">Created at:</label>
                        <div class="col-sm-10">
                            <select  class="form-control" @change='getCompanies()' v-model="orderFilter[2].value" >
                                <option value='0' selected>none</option>
                                <option value='2'>Recent</option>
                                <option value='1'>Oldest</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="staticEmail" class="col-sm-10 col-form-label">Updated at:</label>
                        <div class="col-sm-10">
                            <select  class="form-control" @change='getCompanies()' v-model="orderFilter[3].value" >
                                <option value='0' selected>none</option>
                                <option value='2'>Recent</option>
                                <option value='1'>Oldest</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 form-row">
                    <button class="btn btn-secondary btn-sm" @click="reset()">Remove Filters</button>
                </div>
            </div>
        </div>
        </transition>
    
        <div class="content mt-2">
            <div class='container-fluid'>
                <div class="card text-center">
                    <div class="card-header bg-dark">
                       <h4>Company listing</h4>
                    </div>
                    <div class="card-body row">
                        <p class="col-lg-12 text-left"><small>Total number of items : {{total}}</small></p>
                        <div class="progress col-lg-12 mb-2">
                                <div class="progress-bar" style="color:black" :style='{width:(links.current_page*100)/links.last_page +"%"}' role="progressbar" :aria-valuenow="links.current_page" aria-valuemin="0" :aria-valuemax="links.last_page">
                                    Page {{links.current_page+' of '+links.last_page}}
                                </div>
                        </div>
                        
                        <div class="col-lg-12 row" v-if='total > 0'>
                            <div class="col-lg-6" v-for='(company,index) in companies' :key='"company"+index'>
                                <div class="card text-left">
                                <div class="card-header">
                                    <p><small class="text-muted">#{{parseInt(links.current_page) * 10 - 10 + (index+1)}}</small><a :href="'/admin/company/'+company.company_account.id" target="__blank" > Company : {{company.name}}</a><br>
                                    <small>Address : {{company.company_address.street}}, {{company.company_address.barangay}}, {{company.company_address.town}}, {{company.company_address.city}}</small><br>
                                    <small class="text-muted">Last login {{company.last_log == null || company.last_log == ''?'--':humanTime(company.last_log)}}</small></p>
                                </div>
                                <div class="card-body m-2">
                                    <div class="media row">
                                        <img v-for="(img,index) in company.company_files" :key="index" :src="img.name" style='max-width:50px;max-height:50px' class="align-self-start mr-3 img-fluid img-thumbnail" alt="blank">
                                    <div class="media-body">
                                        <p> Username : {{company.company_account.username}}<br>
                                        email : {{company.email}}<br>
                                        Contact number : {{company.contact_number}}<br>
                                        Landline number : {{company.land_line}}<br>
                                         <small class="text-muted">Company Size: {{company.company_size}}</small></p>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a :href="'/admin/company/'+company.company_account.id" target="__blank" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <button :disabled='disable == 1' type="button" class="btn btn-secondary" @click="archive(company.name,company.company_account.id)">{{archivecompany == 'archive'?'Unarchive':'Archive'}}</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">created {{humanTime(company.created_at)}}</small>
                                    <small class="text-muted">||</small>
                                    <small class="text-muted">Last updated {{humanTime(company.updated_at)}}</small>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 row" v-else>
                            <h3 class="col-lg-12 text-center">No result found</h3>
                        </div>
                      
                    </div>
                    <div class="card-footer">
                        <admins-pagination-companies :links='links' />
                    </div>
                </div>
            </div>
        </div>
        <admins-create-companies :currentPage='current_page'></admins-create-companies>
    </div>
</template>
<script>
export default {
    props:['archivecompany'],
    data(){
        return {
            companies:[],
            search:'',
            filterFlag:0,
            current_page:'',
            total:'',
            disable:'',
            links:{
                first_page:'',
                last_page_url:'',
                prev_page:'',
                next_page:'',
                current_page:'',
                last_page:'',
                path:'', 
            },
            orderFilter:[
                {collumn:'name',value:''},
                {collumn:'last_log',value:''},
                {collumn:'created_at',value:''},
                {collumn:'updated_at',value:''},
            ],
        }
    },
    mounted(){
        this.getCompanies();
    }
    ,
    methods:{
        showFilters(){
            this.filterFlag = this.filterFlag ==1?0:1;
        },
        archive:function(company,id){
            let action = this.archivecompany == 'archive'?'recover':'archive';
            swal({
                title: "Are you sure?",
                text: "You're about to "+action+" "+company+"!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                let vm = this;
                vm.disable = 1;
                axios.patch('/admin/company-archive/'+id)
                .then(function(res){
                    if(res.data.result == 'success'){
                        vm.getCompanies(vm.current_page);
                    }
                    vm.disable = '';
                    console.log(res.data);
                }).catch(function(error){
                    vm.disable = '';
                    console.log(error.response);
                });
                swal("Success", {
                icon: "success",
                });
            } else {
                swal("Aborted");
            }
            });
        },
        getCompanies(url = '/admin/companies/data'){
            let vm = this;
            vm.current_page = url;
            let orders = vm.orderFilter;
            axios.post(url,{
                order:orders,
                search:vm.search,
                archivestatus:vm.archivecompany,
            })
            .then(function(res){
                vm.companies = res.data.data;
                vm.links.first_page = res.data.first_page_url;
                vm.links.last_page_url = res.data.last_page_url;
                vm.links.prev_page = res.data.prev_page_url;
                vm.links.next_page = res.data.next_page_url;
                vm.links.current_page = res.data.current_page;
                vm.links.last_page = res.data.last_page;
                vm.links.path = res.data.path;
                vm.total = res.data.total;
                console.log(res.data.data);
            }).catch(function(err){
                console.log(err.data);
            });
        },
        reset(){
            this.search = '';
            this.orderFilter[0].value=0;
            this.orderFilter[1].value=0;
            this.orderFilter[2].value=0;
            this.orderFilter[3].value=0;
            this.getCompanies();
        }
        ,
        humanTime:function(dateAndTime){
            return moment(dateAndTime).fromNow();
        },
    }
}
</script>
<style>

</style>


