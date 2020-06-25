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

                <div class="list-item" v-for="project in projects" :key="project.guid">
                    <div><span class="badge"></span></div>
                    <a href="#">
                        <span class="avatar">EP</span>
                    </a>
                    <div class="text-truncate">
                        <a :href="project.url" class="text-body d-block">{{ project.name }}</a>
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
                            <input type="text" class="form-control"  placeholder="Your report name" v-model="name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Url listener</label>
                            <input type="text" class="form-control" placeholder="Your report name" v-model="url_listener">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-dismiss="modal">
                            Cancel
                        </a>
                        <a href="javascript:false" class="btn btn-primary ml-auto" v-bind:class="{ disabled: do_add_project }" @click="saveNewProject">
                            Create new project
                            <span class="spinner-border spinner-border-sm ml-2" role="status" v-if="do_add_project"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

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
        url_listener:string = '';

        do_add_project:any = false;

        projects:any = [];


        mounted()
        {
            this.getIndexProjet();
        }

        addNewProject()
        {
            $('#model-add-new-project').modal();
        }

        getIndexProjet()
        {
            axios.get('/api/projects/index')
            .then((response) => {

                if (response.data.status == 'success') {
                    this.projects = response.data.data.projects
                }

            })
            .catch(error => console.error(error));
        }

        saveNewProject()
        {
            this.do_add_project = true;

            axios.post('/api/projects/store', {
                name: this.name,
                url_listener: this.url_listener,
            })
            .then((response) => {
                this.do_add_project = false;

                if (response.data.status == 'success') {
                    this.getIndexProjet();
                    $('#model-add-new-project').modal('hide');
                    this.name = '';
                    this.url_listener = '';
                }

            })
            .catch(error => console.error(error));
        }

    }
</script>
