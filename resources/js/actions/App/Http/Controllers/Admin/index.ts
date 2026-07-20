import DashboardController from './DashboardController'
import PageController from './PageController'
import ServiceController from './ServiceController'
import PartnerController from './PartnerController'
import MessageController from './MessageController'
import SettingController from './SettingController'
import UserController from './UserController'
const Admin = {
    DashboardController: Object.assign(DashboardController, DashboardController),
PageController: Object.assign(PageController, PageController),
ServiceController: Object.assign(ServiceController, ServiceController),
PartnerController: Object.assign(PartnerController, PartnerController),
MessageController: Object.assign(MessageController, MessageController),
SettingController: Object.assign(SettingController, SettingController),
UserController: Object.assign(UserController, UserController),
}

export default Admin