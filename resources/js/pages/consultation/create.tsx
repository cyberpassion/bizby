import { CustomSelect } from '@/components/cyp/custom-select';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardFooter } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { useState } from 'react';
import { useForm } from 'react-hook-form';

import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Consultation Create',
        href: '#',
    },
];

export default function ConsultationCreate() {
    const { register, handleSubmit, reset } = useForm();
    const [loading, setLoading] = useState(false);

    const onSubmit = async (data: any) => {
        setLoading(true);
        try {
            // Send to backend (Inertia or API)
            await fetch('/consultations', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'),
                },
                body: JSON.stringify(data),
            });

            alert('Consultation saved successfully!');
            reset();
        } catch (error) {
            console.error(error);
            alert('Error saving consultation.');
        } finally {
            setLoading(false);
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Consultation Create" />

            <div className="flex items-center justify-center p-4">
                <Card className="w-full shadow-lg">
                    <form onSubmit={handleSubmit(onSubmit)}>
                        <CardContent className="space-y-4">
                            <div>
                                <Label htmlFor="patient_name">
                                    Patient Name
                                </Label>
                                <Input
                                    id="patient_name"
                                    {...register('patient_name')}
                                    placeholder="Enter patient name"
                                    required
                                />
                            </div>

                            <div>
                                <Label htmlFor="department">Department</Label>
                                <CustomSelect
                                    id="department"
                                    placeholder="Select department"
                                    module="consultation"
                                    dataKey={'department-json'}
                                />
                            </div>

                            <div>
                                <Label htmlFor="doctor">Doctor</Label>
                                <Input
                                    id="doctor"
                                    {...register('doctor')}
                                    placeholder="Enter doctor name"
                                    required
                                />
                            </div>

                            <div>
                                <Label htmlFor="consultation_date">
                                    Consultation Date
                                </Label>
                                <Input
                                    id="consultation_date"
                                    type="date"
                                    {...register('consultation_date')}
                                    required
                                />
                            </div>

                            <div>
                                <Label htmlFor="notes">Notes</Label>
                                <Textarea
                                    id="notes"
                                    {...register('notes')}
                                    placeholder="Enter any notes..."
                                />
                            </div>
                        </CardContent>

                        <CardFooter className="flex justify-end pt-4">
                            <Button type="submit" disabled={loading}>
                                {loading ? 'Saving...' : 'Save Consultation'}
                            </Button>
                        </CardFooter>
                    </form>
                </Card>
            </div>
        </AppLayout>
    );
}
