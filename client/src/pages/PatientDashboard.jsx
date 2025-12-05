import { useState, useEffect } from 'react';
import axios from 'axios';
import Button from '../components/Button';

const PatientDashboard = ({ user }) => {
    const [appointments, setAppointments] = useState([]);
    const [doctors, setDoctors] = useState([]);
    const [selectedDoctor, setSelectedDoctor] = useState(null);
    const [slots, setSlots] = useState([]);
    const [loading, setLoading] = useState(false);
    const [activeTab, setActiveTab] = useState('upcoming');

    useEffect(() => {
        fetchAppointments();
        if (activeTab === 'book') fetchDoctors();
    }, [activeTab]);

    const fetchAppointments = async () => {
        try {
            const res = await axios.get(`http://localhost:3000/appointments/user/${user.id}?role=patient`);
            setAppointments(res.data);
        } catch (err) {
            console.error(err);
        }
    };

    const fetchDoctors = async () => {
        try {
            const res = await axios.get('http://localhost:3000/doctors');
            setDoctors(res.data);
        } catch (err) {
            console.error(err);
        }
    };

    const fetchSlots = async (doctorId) => {
        setLoading(true);
        try {
            const res = await axios.get(`http://localhost:3000/doctors/${doctorId}/slots`);
            setSlots(res.data);
        } catch (err) {
            console.error(err);
        }
        setLoading(false);
    };

    const handleBook = async (slotId) => {
        try {
            await axios.post('http://localhost:3000/appointments/book', {
                slot_id: slotId,
                patient_id: user.id
            });
            alert('Appointment booked successfully!');
            setActiveTab('upcoming');
            fetchAppointments();
            setSelectedDoctor(null);
        } catch (err) {
            alert(err.response?.data?.error || 'Booking failed');
        }
    };

    return (
        <div>
            <div className="flex border-b border-gray-200 mb-8">
                <button
                    onClick={() => setActiveTab('upcoming')}
                    className={`px-6 py-4 text-sm font-medium transition-colors border-b-2 ${activeTab === 'upcoming' ? 'border-gray-900 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700'}`}
                >
                    My Appointments
                </button>
                <button
                    onClick={() => setActiveTab('book')}
                    className={`px-6 py-4 text-sm font-medium transition-colors border-b-2 ${activeTab === 'book' ? 'border-gray-900 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700'}`}
                >
                    Book Appointment
                </button>
            </div>

            {activeTab === 'upcoming' ? (
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {appointments.length === 0 && <p className="text-gray-500 text-sm">No upcoming appointments.</p>}
                    {appointments.map(apt => (
                        <div key={apt.id} className="bg-white p-6 rounded-lg border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                            <div className="flex justify-between items-start mb-4">
                                <div>
                                    <h3 className="text-lg font-semibold text-gray-900">{apt.doctor_name}</h3>
                                    <p className="text-gray-500 text-sm">{apt.specialization || 'General Practitioner'}</p>
                                </div>
                                <span className={`px-2.5 py-0.5 rounded-full text-xs font-medium ${apt.status === 'scheduled' ? 'bg-green-50 text-green-700 border border-green-100' : 'bg-gray-100 text-gray-600'}`}>
                                    {apt.status}
                                </span>
                            </div>
                            <div className="text-gray-600 text-sm">
                                <p className="mb-1">{new Date(apt.slot_date).toLocaleDateString(undefined, { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</p>
                                <p className="font-medium text-gray-900">{apt.start_time}</p>
                            </div>
                        </div>
                    ))}
                </div>
            ) : (
                <div className="space-y-8">
                    {!selectedDoctor ? (
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            {doctors.map(doc => (
                                <div key={doc.id} className="bg-white p-6 rounded-lg border border-gray-100 shadow-sm hover:shadow-md transition-all cursor-pointer group" onClick={() => { setSelectedDoctor(doc.id); fetchSlots(doc.id); }}>
                                    <div className="flex items-center gap-4 mb-3">
                                        <div className="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 font-semibold group-hover:bg-gray-900 group-hover:text-white transition-colors">
                                            {doc.name.charAt(0)}
                                        </div>
                                        <div>
                                            <h3 className="text-base font-semibold text-gray-900">{doc.name}</h3>
                                            <p className="text-gray-500 text-sm">{doc.specialization || 'General'}</p>
                                        </div>
                                    </div>
                                    <p className="text-gray-500 text-sm line-clamp-2 mt-2">{doc.bio || 'No bio available.'}</p>
                                </div>
                            ))}
                        </div>
                    ) : (
                        <div>
                            <button onClick={() => setSelectedDoctor(null)} className="mb-6 text-gray-500 hover:text-gray-900 flex items-center gap-2 text-sm font-medium">← Back to Doctors</button>
                            <h3 className="text-xl font-bold text-gray-900 mb-6">Available Slots</h3>
                            {loading ? (
                                <p className="text-gray-500">Loading slots...</p>
                            ) : (
                                <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                    {slots.length === 0 && <p className="text-gray-500 col-span-4">No available slots for this doctor.</p>}
                                    {slots.map(slot => (
                                        <button
                                            key={slot.id}
                                            onClick={() => handleBook(slot.id)}
                                            className="bg-white hover:bg-gray-50 border border-gray-200 p-4 rounded-lg text-center transition-all focus:ring-2 focus:ring-black focus:border-transparent"
                                        >
                                            <p className="font-semibold text-gray-900">{slot.start_time.slice(0, 5)}</p>
                                            <p className="text-xs text-gray-500 mt-1">{new Date(slot.slot_date).toLocaleDateString()}</p>
                                        </button>
                                    ))}
                                </div>
                            )}
                        </div>
                    )}
                </div>
            )}
        </div>
    );
};
export default PatientDashboard;
