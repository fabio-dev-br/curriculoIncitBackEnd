<!-- Seção contendo o botão de cadastro de currículo -->
<section class="pt-2 pb-3">
    <div class="container">
        <div class="row text-left mt-5">
            <div class="col-sm mt-5">

                <!-- Botão para abrir o modal de cadastro de currículo -->
                <button type="button" class="btn btn-lg btn-primary" 
                    data-toggle="modal" 
                    data-target="#curriculumFields"> 
                    Cadastro de currículo
                </button>
            </div>

        </div>
    </div>
</section>

<!-- Modal do cadastro de currículo -->
<div class="modal fade" id="curriculumFields" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="curriculumModal">
        
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                    data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body" >

                <!-- Formulário de currículo, contém: área, curso, arquivo, instituto, ano de formação, id de usuário e habilidades-->
                <form id="curriculumForm">

                    <!-- Área -->
                    <div class="form-group">
                        <label for="curriculumArea"> Área </label>                        
                        <select class="form-control"
                            id="curriculumArea"
                            v-model="area" required>
                            <option selected disabled> Escolha a área maior de atuação... *</option>
                            <option value="exatas"> Exatas </option>
                            <option value="humanas"> Humanas </option>
                            <option value="biologicas"> Biológicas </option>
                        </select>
                        <p class="help-block text-danger"></p>
                    </div>

                    <!-- Curso -->
                    <div class="form-group">
                        <label for="curriculumCourse"> Curso </label>
                        <input type="text" class="form-control bg-transparent"
                            id="curriculumCourse"        
                            v-model="course"
                            placeholder="Digite o curso de formação... *" required>
                    </div>

                    <!-- Arquivo de currículo -->
                    <div class="form-group">
                        <label for="curriculumFile"> Arquivo de currículo </label>
                        <input type="file" class="form-control-file"
                            id="curriculumFile"
                            v-on:change="onFileSelected"
                            required> 
                    </div>

                    <!-- Instituição de ensino -->
                    <div class="form-group">
                        <label for="curriculumInstitute"> Instituição de ensino </label>
                        <input type="text" class="form-control bg-transparent"
                            id="curriculumInstitute"        
                            v-model="institute"
                            placeholder="Digite o instituto de formação... *" required>
                    </div>

                    <!-- Ano de formação -->
                    <div class="form-group">
                        <label for="curriculumGradYear"> Ano de formação </label>
                        <input type="text" class="form-control bg-transparent"
                            id="curriculumGradYear"        
                            v-model="graduateYear"
                            placeholder="yyyy *" required>
                    </div>

                    <!-- Habilidades -->
                    <div class="form-group">
                        <!-- <label for="curriculumHabilities"> Principais habilidades </label>
                        <tags-input element-id="tags"
                            v-model="selectedTags"
                            :existing-tags="{ 
                                'web-development': 'Web Development',
                                'php': 'PHP',
                                'javascript': 'JavaScript',
                            }"
                            :typeahead="true"></tags-input> -->
                    </div>
                </form>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" 
                    data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" 
                    data-dismiss="modal" 
                    v-on:click="sendInfo()"
                    >Enviar</button>
            </div>
        </div>
    </div>    
</div>