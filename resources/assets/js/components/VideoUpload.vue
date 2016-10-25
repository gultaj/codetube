<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Upload</div>

                    <div class="panel-body">
                        <div class="form-group" v-if="!uploading">
                            <label for="title" class="col-md-3 text-right control-label">Video file</label>
                            <div class="col-md-9">
                                <input type="file" name="video" id="video" @change="fileInputChange" >  
                            </div>
                        </div>
                                            
                        <div class="video-form form-horizontal" v-if="uploading && !failed">                            
                            <div class="form-group">
                                <label for="title" class="col-md-3 control-label">Title</label>
                                <div class="col-md-9">
                                    <input id="title" type="text" class="form-control" name="title" v-model="title" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-md-3 control-label">Description</label>
                                <div class="col-md-9">
                                    <textarea name="description" id="description" class="form-control" v-model="description"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="visibility" class="col-md-3 control-label">Visibility</label>
                                <div class="col-md-9">
                                    <select name="visibility" id="visibility" class="form-control" v-model="visibility">
                                        <option value="private">Private</option>
                                        <option value="unlisted">Unlisted</option>
                                        <option value="public">Public</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary" @click.prevent="update">Save changes</button>
                                    <span class="help-block pull-right">{{ saveStatus }}</span>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                uid: null,
                uploading: false,
                uploadingComplete: false,
                failed: false,
                title: 'Untitled',
                description: null,
                visibility: 'private',
                saveStatus: null
            };
        },
        methods: {
            fileInputChange() {
                this.uploading = true;
                this.failed = false;

                this.file = document.getElementById('video').files[0];

                this.store().then(() => {
                    //
                });
            },
            store() {
                return this.$http.post('/videos', {
                    title: this.title,
                    description: this.description,
                    visibility: this.visibility,
                    extension: this.file.name.split('.').pop()
                }).then((response) => response.json()).then(result => {
                    this.uid = result.data.uid;
                });
            },
            update() {
                this.saveStatus = 'Save changes';
                return this.$http.put('/videos/' + this.uid, {
                    title: this.title,
                    description: this.description,
                    visibility: this.visibility,
                }).then((response) => response.json())
                .then(result => {
                    this.saveStatus = 'Changes saved';

                    setTimeout(() => {
                        this.saveStatus = null;
                    }, 3000);
                }).catch(error => {
                    this.saveStatus = 'Fail to saved changes';
                });
            }
        }
    }
</script>
