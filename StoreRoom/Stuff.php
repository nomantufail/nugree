------------------------------------- Uniqe Email ------------------------------------------

unique:agencies,email'.(($this->request->get('agencyId') != null)?','.$this->request->get('agencyId'):'').'
------------------------------------- Uniqe agent with uniq agency ------------------------------------------
unique:agencies,agency'.(($this->request->get('agencyId') != null)?','.$this->request->get('agencyId'):'').'