export default class Gate{

    constructor(user){

    	this.user = user;
    }


    isAdmin(){
    	return this.user.type === 'admin';
    }


    isEmpleado(){
    	return this.user.type === 'empleado';
    }

    isInvitado(){
    	return this.user.type === 'invitado';
    }
}