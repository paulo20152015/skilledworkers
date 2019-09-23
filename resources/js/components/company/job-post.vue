<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="#" style="margin-right:auto">Job Posts Management</a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item"><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#specialization">
                    Job Specialization <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                </button></li>
                <li class="nav-item active">
                    <a class="nav-link" href="#" @click="toggleComponents('manage_content')" >Manage Content</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" @click="toggleComponents('manage_application')" >Application Management</a>
                </li>
            </ul>
            </div>

        </nav>
        <manage-content v-if='manage_content == 1' ></manage-content>       
        <application-management v-if='manage_application == 1' ></application-management>
        <!-- Modal -->
        <div class="modal fade" id="specialization" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Job Specialization Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jobspecialization">Job Specialization * </label>
                        <input v-model="specializationCreateForm.specialization"   name="specialization" type="text" class="form-control" id="jobspecialization" placeholder="Enter a job specialization">
                        <div> 
                            <transition  enter-active-class="animated flipInX" leave-active-class="animated fadeOutRight">
                                <p class='error' v-if="specializationCreateForm.errors.has('specialization')">
                                {{ specializationCreateForm.errors.get('specialization') }}
                                </p>
                            </transition>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button  type="button" class="btn btn-primary" @click="addSpecialization()">
                     <i v-if="spinner == 1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></i>
                     Add Specialization</button>
                </div>
            </div>
            </div>
        </div>
        <!-- Modal -->
    </div>
</template>
<script>
export default {
    data(){
        return{
            spinner:'',
            specialization:'',
            city:'',
            specializationCreateForm:new Form({
                specialization:''
            }),
            postdata:'',
            manage_content:1,
            manage_application:''
        }
    },
    mounted(){
 
    },
    methods:{
        addSpecialization(){
            let vm = this;
            swal({
            title: "Click ok to proceed",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                vm.spinLoading();
                vm.specializationCreateForm.post('/admin/addSpecialization')
                .then( ({data}) => {
                    console.log(data);
                    swal('Success','','success');
                    vm.spinLoading();
                    window.location.reload();
                }).catch(function(error){
                    vm.spinLoading();
                });
            } else {
                swal("Action has been cancelled!");
            }
            });
            

        },
        spinLoading(){
            this.spinner = this.spinner != 1 ?1:'';
        },
        toggleComponents(val){
            let vm = this;
            switch (val) {
                case 'manage_content':
                    vm.manage_content = 1;
                    vm.manage_application = '';
                    break;
                case 'manage_application':
                    vm.manage_content = '';
                    vm.manage_application = 1;
                    break;    
                default:
                    break;
            }
        },
       
    }
}
</script>

