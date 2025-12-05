import { useAuth } from '../context/AuthContext';
import Button from '../components/Button';
import { useNavigate } from 'react-router-dom';
import PatientDashboard from './PatientDashboard';
import DoctorDashboard from './DoctorDashboard';

const Dashboard = () => {
    const { user, logout } = useAuth();
    const navigate = useNavigate();

    const handleLogout = () => {
        logout();
        navigate('/login');
    };

    return (
        <div className="min-h-screen bg-gray-50 text-gray-900 font-sans">
            <nav className="bg-white border-b border-gray-200 sticky top-0 z-50">
                <div className="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                    <div className="flex items-center gap-3">
                        <div className="w-8 h-8 bg-gray-900 rounded-lg flex items-center justify-center text-white font-bold">W</div>
                        <h1 className="text-lg font-semibold tracking-tight text-gray-900">WhatsUpDoc</h1>
                    </div>

                    <div className="flex items-center gap-6">
                        <div className="text-right hidden sm:block">
                            <p className="text-sm font-medium text-gray-900">{user?.name}</p>
                            <p className="text-xs text-gray-500 capitalize">{user?.role}</p>
                        </div>
                        <Button onClick={handleLogout} variant="secondary" className="bg-gray-100 border-transparent hover:bg-gray-200 py-2 px-4 shadow-none">Sign Out</Button>
                    </div>
                </div>
            </nav>

            <main className="max-w-7xl mx-auto px-6 py-10">
                {user?.role === 'patient' && <PatientDashboard user={user} />}
                {user?.role === 'doctor' && <DoctorDashboard user={user} />}
                {user?.role === 'admin' && <div className="text-center text-gray-400 mt-20">Admin dashboard under construction.</div>}
            </main>
        </div>
    );
};
export default Dashboard;
