<div class="modal fade" id="Add_formModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                <form method="POST" id="Add_sample_form" class="form-horizontal" enctype="multipart/form-data">
                    <!-- Model header -->
                    @csrf
                    @method('POST')
                    <div class="modal-header" >
                        <h5 class="modal-title" id="Add_ModalLabel">Add New Record</h5>
                        </div>
                    <!-- Model Body -->
                    <div class="modal-body">
                        <span id="Add_form_result"></span>

                        <div class="form-group">
                            <input type="hidden" name="user_id" id="user_id" value="{{auth()->user()->id}}" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Post Title : </label>
                            <input type="text" name="title" id="Add_title" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Post Description : </label>
                            <textarea type="text" name="post_text" id="Add_post_text" class="form-control" ></textarea>
                        </div>
                        <div class="form-group">
                            <label>Post Category : </label>
                            <select name="category_id" id="category_id" class="form-control">
                            <option id="category_id">Select Category</option>
                                @foreach($category as $post)
                                
                                <option id="category_id" value="{{$post->id}}">
                                            {{$post->name}}         
                                </option>
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="form-group">
                            <label>Post Image  : </label>
                            <input type="file" name="image" id="Add_image" class="form-control" />
                        </div>
                        
                        <input type="hidden" name="Add_action" id="Add_action" value="Add" />
                        
                    </div>
                    <!-- Model Footer -->

                        <div class="modal-footer">
                        
                        <input type="submit" name="Add_action_button" id="Add_action_button" value="Add" class="btn btn-info" /> 
                        <button type="button"  name="close_btn" data-dismiss="modal"  id="close_btn" class="btn btn-secondary">Close</button>
                    </div> 
                </form>
                </div>
                </div>
            </div>
