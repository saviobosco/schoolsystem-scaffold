<?php
namespace Dashboard\Controller;
use Cake\ORM\TableRegistry;
use Dashboard\Controller\AppController;
use Cake\Core\Configure;
use Settings\Core\Setting;
/**
 * Settings Controller
 *
 * @property \Settings\Model\Table\ConfigurationsTable $Configurations
 */
class SettingsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Settings.Configurations');
    }


    public function index()
    {
        $selectOptions = []; // Initialised the form select options
        //Setting::write('Application.school_motto', '');

        $key = 'Application';
        $settings = $this->Configurations->find('all')->where([
            'name LIKE' => $key . '%',
            'editable' => 1,
        ])->order(['weight', 'id'])->toArray();

        // Getting the account types
        $accountTypeSettings = $this->Configurations->find('all')->where([
            'name LIKE' => 'Account_Type_Settings%',
            'editable' => 1,
        ])->order(['weight', 'id'])->toArray();

        $sessions = TableRegistry::get('ResultSystem.Sessions')->query()->find('list')->toArray();
        $terms = TableRegistry::get('ResultSystem.Terms')->query()->find('list',['limit' => 3])->toArray();
        foreach ($settings as $setting) {
            if ($setting->type === 'select') {
                $nameArray = explode('.',$setting->name);
                $name = end($nameArray);
                switch($name) {
                    case 'current_session':
                        $selectOptions[$setting->id] = $sessions;
                        break;
                    case 'current_term':
                        $selectOptions[$setting->id] = $terms;
                        break;
                    default: // do nothing
                }
            }
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $settings = $this->Configurations->patchEntities($settings, $this->request->getData());
            if (!$this->Configurations->saveMany($settings)) {
                $this->Flash->error('The settings could not be saved. Please, try again.');
            } else {
                $this->Flash->success('The settings has been saved.');
            }
            Setting::clear(true);
            Setting::autoLoad();
        }
        $this->set(compact('prefix', 'settings', 'sessions', 'terms','selectOptions', 'accountTypeSettings'));
    }

    public function updateAccountTypeSettings()
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $accountTypeSettings = $this->Configurations->find('all')->where([
                'name LIKE' => 'Account_Type_Settings%',
                'editable' => 1,
            ])->order(['weight', 'id'])->toArray();
            $settings = $this->Configurations->patchEntities($accountTypeSettings, $this->request->getData());
            if (!$this->Configurations->saveMany($settings)) {
                 $responseMessage = __('The settings could not be saved. Please, try again.');
            } else {
                $responseMessage = __('The settings has been saved.');
            }
            Setting::clear(true);
            Setting::autoLoad();
            return $this->response->withStatus(200)->withStringBody($responseMessage);
        }
    }

    public function uploadBannerImage()
    {
        if (!Setting::check('Application.image_banner')) {
            Setting::register('Application.image_banner', '',['editable' => 0]);
        }
        if ( $this->request->is(['patch', 'post', 'put'])) {
            $settingsTable = Setting::model();
            $bannerImage = $settingsTable->findByName('Application.image_banner')->first();
            try {
                $uploadedImage = $this->request->getUploadedFile('banner');
                if (empty($uploadedImage)) {
                    $this->Flash->error(__('No file selected.'));
                    return $this->redirect($this->request->referer());
                }
                if (!in_array($uploadedImage->getClientMediaType(), ['image/png', 'image/jpg', 'image/jpeg'])) {
                    $this->Flash->error(__('banner must be a valid image.'));
                    return $this->redirect($this->request->referer());
                }
                if ($bannerImage) {
                    if (!empty($bannerImage['value'])) {
                        $real_file_path = WWW_ROOT. substr(parse_url($bannerImage['value'])['path'], 1);
                        if (file_exists($real_file_path)) {
                            unlink($real_file_path);
                        }
                    }
                }
                try {
                    $destination = WWW_ROOT.'img/schools/'.Configure::read('sub_domain').'/'.$uploadedImage->getClientFilename();
                    $uploadedImage->moveTo($destination);
                    $bannerImage = $settingsTable->patchEntity($bannerImage, [
                        'value' => 'http://'.$this->request->host().'/img/schools/'.
                            Configure::read('sub_domain').'/'. $uploadedImage->getClientFilename()
                    ]);
                    $settingsTable->save($bannerImage);
                    $this->Flash->success(__('File was successfully uploaded'));
                } catch (\InvalidArgumentException $invalidArgument) {
                    $this->Flash->error($invalidArgument->getMessage());
                } catch (\RuntimeException $runtime) {
                    $this->Flash->error($runtime->getMessage());
                }
            } catch (\Exception $e ) {
                $this->Flash->error(__('An Error occurred uploading this image. Please try again.'));
            }
            return $this->redirect($this->referer());
        }
    }


    public function uploadSchoolLogo()
    {
        if (!Setting::check('Application.school_logo')) {
            Setting::register('Application.school_logo', '',[
                'editable' => 0, 'type' => 'file',
                'description' => 'School Logo'
            ]);
        }
        $settingsTable = Setting::model();
        $schoolLogo = $settingsTable->findByName('Application.school_logo')->first();
        if ( $this->request->is(['patch', 'post', 'put'])) {
            try {
                // check if upload
                if (empty($this->request->getData('logo')['name'])) {
                    $this->Flash->error(__('No file selected.'));
                    return $this->redirect($this->request->referer());
                }
                $imageDetails = pathinfo($this->request->getData('logo')['name']);
                if (!in_array($imageDetails['extension'], ['png', 'jpg', 'jpeg'])) {
                    $this->Flash->error(__('Image must be a .png file .'));
                    return $this->redirect($this->request->referer());
                }
                // check if folder is writable

                if ( move_uploaded_file($this->request->getData('logo')['tmp_name'], WWW_ROOT.'img/schools/'.Configure::read('sub_domain') .'/school-logo.jpg') ) {
                    $schoolLogo = $settingsTable->patchEntity($schoolLogo, [
                        'value' => 'http://'.$this->request->host().'/img/schools/'.
                            Configure::read('sub_domain').'/school-logo.jpg'
                    ]);
                    $settingsTable->save($schoolLogo);
                    $this->Flash->success(__('File was successfully uploaded'));
                } else {
                    $this->Flash->error(__('An Error occurred uploading this image. Please try again.'));
                }
            } catch (\Exception $e ) {
                $this->Flash->success(__('An Error occurred uploading this image. Please try again.'));
            }
            return $this->redirect($this->referer());
        }
        $this->set(compact('schoolLogo'));
    }
}
