<template>
    <div>


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Projects list</h3>
                <div class="card-options">
                    <a href="javascript:false" class="btn btn-primary btn-sm" @click="addNewProject">Create new project</a>
                </div>
            </div>
            <div class="list list-row list-hoverable">

                <div class="list-item">
                    <div><span class="badge"></span></div>
                    <a href="#">
                        <span class="avatar">EP</span>
                    </a>
                    <div class="text-truncate">
                        <a href="#" class="text-body d-block">Egan Poetz</a>
                        <small class="d-block text-muted text-truncate mt-n1">Copywriting edits</small>
                    </div>
                </div>

            </div>
        </div>


        <div class="modal modal-blur fade" id="model-add-new-project" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New project</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="example-text-input" placeholder="Your report name" v-model="name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-dismiss="modal">
                            Cancel
                        </a>
                        <a href="javascript:false" class="btn btn-primary ml-auto" @click="saveNewProject">
                            Create new project
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    // export default {
    //     mounted() {
    //         console.log('Component mounted.')
    //     }
    // }

</script>

<script lang="ts">
    import Vue from 'vue';
    import {
        Component,
        Prop
    } from 'vue-property-decorator';
    import axios from 'axios';

    @Component
    export default class ProjetsIndexComponent extends Vue
    {
        name:string = '';

        addNewProject()
        {
            console.log((<any>window).axios);
            $('#model-add-new-project').modal();
        }

        saveNewProject()
        {
            axios.post('/api/projects/store', {
                name: this.name,
            })
            .then((response) => {
                console.log(response.data);
            })
            .catch(error => console.error(error));
        }

    }

</script>
