<?php
/**
* @version $Revision$
* @author $Author$
* @since $Date$
*/
namespace App\Http\Requests;

use App\Http\Requests\Request;


class QuestionarioUpdateRequest extends Request {
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            //
        ];
    }
    
}
