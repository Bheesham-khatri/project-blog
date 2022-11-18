<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" id="edit_sample_form" class="form-horizontal" enctype="multipart/form-data">
                            <!-- Model header -->
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabel">Edit New Record</h5>
                            </div>
                            <!-- Model Body -->
                            <div class="modal-body">
                                <span id="form_result"></span>
                                <div class="form-group">
                                    <label>Post Title : </label>
                                    <input type="text" name="title" id="title" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Post Description : </label>
                                    <textarea type="text" name="post_text" id="post_text" class="form-control">

                                </textarea>
                                </div>
                                <div class="form-group">
                                    <label>Post Category : </label>
                                    <select name="category" id="category" class="form-control">
                                        @foreach($category as $post)
                                        <option value="{{$post->id}}">
                                            {{$post->name}}
                                        </option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label>Post Image : </label>
                                    <input type="file" name="image" id="image" class="form-control" />
                                    <div id="dvimage">
                                        <img id="img" src="" width="65px" class="img-circle">
                                    </div>
                                </div>

                                <input type="hidden" name="action" id="action" value="Add" />
                                <input type="hidden" name="hidden_id" id="hidden_id" />
                            </div>
                            <!-- Model Footer -->

                            <div class="modal-footer">

                                <input type="submit" name="action_button" id="action_button" value="Add" class="btn btn-info" />
                                <button type="button" name="close_btn" data-dismiss="modal" id="close_btn" class="btn btn-secondary">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>