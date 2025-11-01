<!-- resources/views/consultation/create.blade.php -->

<form id="form-consultation-entry"
      name="form-consultation-entry"
      class="w-full ajax-op-parent"
      method="POST"
      action="{{ route('consultation.store') }}"
      data-submit-pg="form/consultation/entry">

    @csrf

    {{-- Doctor Information --}}
    <fieldset class="form_group" id="doctor_information" data-label="Doctor Info">
        <legend>Doctor Info</legend>

        <div class="inline-table w-[50%]">
            <select id="consultation_with" name="consultation_with"
                    data-key="consultation_with-json"
                    class="w-[60%] mandatory"
                    data-label="Doctor Name">
            </select>

            <button type="button"
                    id="refresh-checkuptypes"
                    data-param='{"key":"form:employee/applicable-consultationtypes/new"}'
                    class="ajax-op singleop_button hidden"
                    value="Refresh"
                    data-submit-pg="endpoint/consultation"
                    data-delivery_in="delivr"
                    data-text-centerallback="dont_show">
                Refresh
            </button>

            <button type="button"
                    id="add-employee"
                    data-param='{"key":"form:employee/entry/new","heading":"New Employee Entry"}'
                    class="ajax-op singleop_button"
                    value="+Add"
                    data-submit-pg="endpoint/module"
                    data-delivery_in="delivr">
                +Add
            </button>
        </div>

        <div class="inline-table w-[50%]">
            <input type="text"
                   id="consultation_time"
                   name="consultation_time"
                   data-key="consultation_time_slot-json"
                   class="w-[20%] consultation_time jqtime_v2 mandatory"
                   data-label="Date and Time" />

            <input type="text"
                   id="consultation_date"
                   name="consultation_date"
                   class="w-[40%] jqdate"
                   style="margin:0 0 0 -0.9%;" />

            <button type="button"
                    id="refresh-consultationslots"
                    data-param='{"key":"consultation_slots"}'
                    class="ajax-op singleop_button hide"
                    value="Refresh"
                    data-submit-pg="endpoint/consultation"
                    data-delivery_in="delivr"
                    data-text-centerallback="show_n_hide_veryquick">
                Refresh
            </button>
        </div>

        <div class="inline-table w-[50%]">
            <input id="consultation_fee"
                   name="consultation_fee"
                   class="w-[60%] mandatory"
                   data-label="Fee" />

            <input id="consultation_extra_amount"
                   name="consultation_extra_amount"
                   class="w-[20%] hidden"
                   placeholder="Extra Amt (if any)"
                   style="margin-left:-0.9%;" />
        </div>

        <div class="inline-table w-[50%]">
            <select id="consultation_for"
                    name="consultation_for[]"
                    class="w-[60%] s2 mandatory"
                    data-key="consultation_for-json"
                    data-label="For"
                    multiple>
            </select>
        </div>
    </fieldset>

    {{-- Patient Information --}}
    <fieldset class="form_group" id="patient_information" data-label="Patient Info">
        <legend>Patient Info</legend>

        <div class="inline-table w-[50%]">
            <input type="text"
                   id="patient_name"
                   name="patient_name"
                   data-label="Patient Name"
                   class="ac-name w-[60%] mandatory"
                   placeholder="Patient Name" />
        </div>

        <div class="inline-table w-[50%]">
            <input type="number"
                   id="age"
                   name="age"
                   class="w-[10%]"
                   data-label="Age" />
            <input type="text"
                   id="dob"
                   name="dob"
                   class="w-[50%] jqdate hide mandatory"
                   placeholder="DOB"
                   style="margin-left:-0.9%;" />
        </div>

        <div class="inline-table w-[50%]">
            <input type="text"
                   id="phone_number"
                   name="phone_number"
                   class="w-[60%] mandatory allowcomma"
                   data-label="Phone Number" />
        </div>

        <div class="inline-table w-[50%]">
            <select id="gender"
                    name="gender"
                    class="w-[60%]"
                    data-label="Gender"
                    data-key="gender-json">
            </select>
        </div>

        <div class="inline-table w-[50%]">
            <select id="guardian_type"
                    name="guardian_type"
                    class="w-[20%]"
                    data-label="Guardian"
                    data-key="humanrelationship_name-json">
            </select>
            <input type="text"
                   id="guardian_name"
                   name="guardian_name"
                   class="ac-name w-[40%] mandatory"
                   placeholder="Guardian Name"
                   style="margin-left:-0.9%;" />
        </div>

        <div class="inline-table w-[50%] hidden">
            <input type="text"
                   id="aadhar_number"
                   name="aadhar_number"
                   class="w-[60%]"
                   data-label="Aadhar No."
                   maxlength="12" />
        </div>

        <div class="inline-table w-[50%]">
            <input type="text"
                   id="permanent_address"
                   name="permanent_address"
                   data-label="Address"
                   class="w-[60%]"
                   placeholder="Address" />
        </div>

        <div class="inline-table w-[50%]">
            <select id="consultation_through"
                    name="consultation_through"
                    data-key="consultation_through_mode-json"
                    class="w-[60%] mandatory"
                    data-label="Mode">
            </select>
            <button type="button"
                    id="add-nextvisitdays"
                    data-param='{"key":"form:module-setting/single/new","option_name":"consultation_through_mode-json","option_name_mask":"Enter New Mode","redir_key":"consultation_through"}'
                    class="ajax-op singleop_button"
                    value="+ New"
                    data-submit-pg="endpoint/module"
                    data-delivery_in="delivr">
                + New
            </button>
        </div>
    </fieldset>

    {{-- Follow-up Information --}}
    <fieldset class="form_group" id="followup_information" data-label="Followup Info">
        <legend>Followup Info</legend>

        <div class="inline-table w-[50%]">
            <select id="expected_next_consultation_after"
                    name="expected_next_consultation_after"
                    data-key="consultation_next_consultation_after-json"
                    class="w-[60%] s2 mandatory"
                    data-label="Next Visit After">
            </select>
            <button type="button"
                    id="add-nextvisitdays"
                    data-param='{"key":"form:module-setting/single/new","option_name":"consultation_next_consultation_after-json","option_name_mask":"Enter New Days Interval","redir_key":"expected_next_consultation_after"}'
                    class="ajax-op singleop_button"
                    value="+ New"
                    data-submit-pg="endpoint/module"
                    data-delivery_in="delivr">
                + New
            </button>
        </div>

        <div class="inline-table w-[50%]">
            <select id="referred_by"
                    name="referred_by"
                    data-label="Referred By"
                    data-key="hospital_referral-json"
                    class="w-[60%]">
            </select>
            <button type="button"
                    id="add-referred_by"
                    data-param='{"key":"form:module-setting/single/new","option_name":"hospital_referral-json","option_name_mask":"Enter New Referral Name","redir_key":"referred_by,#referred_to"}'
                    class="ajax-op singleop_button"
                    value="+ New"
                    data-submit-pg="endpoint/module"
                    data-delivery_in="delivr">
                + New
            </button>
        </div>

        <div class="inline-table w-[50%]">
            <input type="text"
                   id="remark"
                   name="remark"
                   data-label="Remark (if any)"
                   class="w-[60%] mandatory" />
        </div>

        <div class="inline-table w-[50%]">
            <select id="referred_to"
                    name="referred_to"
                    data-label="Referred To"
                    data-key="hospital_referral-json"
                    class="w-[60%]">
            </select>
            <button type="button"
                    id="add-referred_to"
                    data-param='{"key":"form:module-setting/single/new","option_name":"hospital_referral-json","option_name_mask":"Enter New Referral Name","redir_key":"referred_to,#referred_by"}'
                    class="ajax-op singleop_button"
                    value="+ New"
                    data-submit-pg="endpoint/module"
                    data-delivery_in="delivr">
                + New
            </button>
        </div>
    </fieldset>

    {{-- Hidden Fields & Submit --}}
    <div id="submission" class="fixed-at-bottom text-left">
        <input type="hidden" id="consultation_id" name="consultation_id" />
        <input type="hidden" id="consultation_group_id" name="consultation_group_id" />
        <input type="hidden" id="next_date" name="next_date" />
        <input type="hidden" id="status" name="status" />
        <input type="hidden" id="path" name="path" value="consultation/entry/new" />

        <button type="submit"
                id="submit"
                name="submit"
                class="ajax-submit blue_button"
                value="Save"
                data-delivery_in="delivr">
            Save
        </button>
    </div>
</form>
